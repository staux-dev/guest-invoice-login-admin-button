<?php

declare(strict_types=1);

require_once __DIR__ . '/init.php';

use WHMCS\Database\Capsule;

function guest_invoice_base64url_encode(string $data): string
{
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function guest_invoice_base64url_decode(string $data): string
{
    $remainder = strlen($data) % 4;
    if ($remainder !== 0) {
        $data .= str_repeat('=', 4 - $remainder);
    }
    $decoded = base64_decode(strtr($data, '-_', '+/'), true);
    return $decoded === false ? '' : $decoded;
}

function guest_invoice_get_secret_key(): string
{
    global $cc_encryption_hash;
    if (is_string($cc_encryption_hash) && $cc_encryption_hash !== '') {
        return hash('sha256', $cc_encryption_hash . '|guest_invoice_shortener', true);
    }

    $systemUrl = (string) Capsule::table('tblconfiguration')->where('setting', 'SystemURL')->value('value');
    return hash('sha256', $systemUrl . '|guest_invoice_shortener', true);
}

function guest_invoice_equals(string $a, string $b): bool
{
    if (function_exists('hash_equals')) {
        return hash_equals($a, $b);
    }
    if (strlen($a) !== strlen($b)) {
        return false;
    }
    $res = 0;
    for ($i = 0, $len = strlen($a); $i < $len; $i++) {
        $res |= ord($a[$i]) ^ ord($b[$i]);
    }
    return $res === 0;
}

$pathInfo = (string) ($_SERVER['PATH_INFO'] ?? '');
$fullUri = (string) ($_SERVER['REQUEST_URI'] ?? '');

$token = '';
if (isset($_GET['t']) && is_string($_GET['t'])) {
    $token = trim($_GET['t']);
}

if ($token === '' && $pathInfo !== '' && strpos($pathInfo, '.') !== false) {
    $segments = array_values(array_filter(explode('/', trim($pathInfo, '/')), 'strlen'));
    if ($segments) {
        $last = (string) end($segments);
        if (substr_count($last, '.') === 1) {
            $token = $last;
        }
    }
}

$invoiceId = 0;
$clientId = 0;
$expiryTime = 0;

if ($token !== '') {
    if (substr_count($token, '.') !== 1) {
        http_response_code(400);
        echo 'Invalid token';
        exit;
    }

    [$payloadB64, $sigB64] = explode('.', $token, 2);
    $payloadJson = guest_invoice_base64url_decode($payloadB64);
    if ($payloadJson === '') {
        http_response_code(400);
        echo 'Invalid token';
        exit;
    }

    $payload = json_decode($payloadJson, true);
    if (!is_array($payload)) {
        http_response_code(400);
        echo 'Invalid token';
        exit;
    }

    $sigRaw = guest_invoice_base64url_decode($sigB64);
    if ($sigRaw === '') {
        http_response_code(400);
        echo 'Invalid token';
        exit;
    }

    $expectedSig = hash_hmac('sha256', $payloadB64, guest_invoice_get_secret_key(), true);
    if (!guest_invoice_equals($expectedSig, $sigRaw)) {
        http_response_code(403);
        echo 'Invalid token';
        exit;
    }

    $invoiceId = isset($payload['i']) ? (int) $payload['i'] : 0;
    $clientId = isset($payload['u']) ? (int) $payload['u'] : 0;
    $expiryTime = isset($payload['e']) ? (int) $payload['e'] : 0;
    $version = isset($payload['v']) ? (int) $payload['v'] : 0;

    if ($version !== 1 || $invoiceId <= 0 || $clientId <= 0 || $expiryTime <= 0) {
        http_response_code(400);
        echo 'Invalid token';
        exit;
    }

    if (time() > $expiryTime) {
        http_response_code(410);
        echo 'Link expired';
        exit;
    }
} else {
    $code = '';
    if (isset($_GET['code']) && is_string($_GET['code'])) {
        $code = trim($_GET['code']);
    }

    if ($code === '' && isset($_GET['slug']) && is_string($_GET['slug'])) {
        $slugValue = trim($_GET['slug']);
        if (preg_match('/-([A-Za-z0-9_-]{6,32})$/', $slugValue, $m)) {
            $code = (string) $m[1];
        }
    }

    if ($code === '' && $pathInfo !== '') {
        $segments = array_values(array_filter(explode('/', trim($pathInfo, '/')), 'strlen'));
        if ($segments) {
            $candidate = (string) end($segments);
            if (preg_match('/-([A-Za-z0-9_-]{6,32})$/', $candidate, $m)) {
                $code = (string) $m[1];
            }
        }
    }

    if ($code === '' && $fullUri !== '') {
        $pathOnly = explode('?', $fullUri, 2)[0];
        $candidate = trim($pathOnly, '/');
        if ($candidate !== '' && preg_match('/-([A-Za-z0-9_-]{6,32})$/', $candidate, $m)) {
            $code = (string) $m[1];
        }
    }

    if ($code === '') {
        http_response_code(400);
        echo 'Missing code';
        exit;
    }

    $shortTable = 'mod_guest_invoice_shortlinks';
    try {
        $schema = Capsule::schema();
        if (method_exists($schema, 'hasTable') && !$schema->hasTable($shortTable)) {
            http_response_code(404);
            echo 'Not found';
            exit;
        }
    } catch (\Throwable $e) {
        http_response_code(500);
        echo 'Error';
        exit;
    }

    $row = Capsule::table($shortTable)->where('code', $code)->first();
    if (!$row) {
        http_response_code(404);
        echo 'Not found';
        exit;
    }

    $invoiceId = isset($row->invoice_id) ? (int) $row->invoice_id : 0;
    $clientId = isset($row->client_id) ? (int) $row->client_id : 0;
    $expiryTime = isset($row->expiry_time) ? (int) $row->expiry_time : 0;

    if ($invoiceId <= 0 || $clientId <= 0 || $expiryTime <= 0) {
        http_response_code(404);
        echo 'Not found';
        exit;
    }

    if (time() > $expiryTime) {
        http_response_code(410);
        echo 'Link expired';
        exit;
    }
}

$clientResult = localAPI('EncryptPassword', ['password2' => $clientId]);
if (!isset($clientResult['password']) || !is_string($clientResult['password'])) {
    http_response_code(500);
    echo 'Could not generate link';
    exit;
}

$invoiceResult = localAPI('EncryptPassword', ['password2' => $invoiceId]);
if (!isset($invoiceResult['password']) || !is_string($invoiceResult['password'])) {
    http_response_code(500);
    echo 'Could not generate link';
    exit;
}

$expiryResult = localAPI('EncryptPassword', ['password2' => $expiryTime]);
if (!isset($expiryResult['password']) || !is_string($expiryResult['password'])) {
    http_response_code(500);
    echo 'Could not generate link';
    exit;
}

$whmcsBaseUrl = (string) Capsule::table('tblconfiguration')->where('setting', 'SystemURL')->value('value');
$whmcsBaseUrl = rtrim($whmcsBaseUrl, '/') . '/';

$destination = $whmcsBaseUrl
    . 'index.php?m=guest_invoice_module'
    . '&clientid=' . rawurlencode($clientResult['password'])
    . '&invoiceid=' . rawurlencode($invoiceResult['password'])
    . '&expi=' . rawurlencode($expiryResult['password'])
    . '&guestuser=true';

header('Location: ' . $destination, true, 302);
exit;
