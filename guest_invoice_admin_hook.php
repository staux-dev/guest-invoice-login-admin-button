<?php
/**
 * Guest Invoice Module - Admin Hook
 * Adds "Guest Invoice Link" button to admin invoice page
 * Place this file in: includes/hooks/guest_invoice_admin_button.php
 */

use WHMCS\Database\Capsule;

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

add_hook('AdminAreaHeadOutput', 1, function($vars) {
    // DEBUG: Always output to see if hook runs
    $debugOutput = '<script>console.log("Guest Invoice Hook: Hook executing...");</script>';
    
    // Check if we're on the invoice edit page using REQUEST_URI for friendly URLs
    $requestUri = $_SERVER['REQUEST_URI'] ?? '';
    $currentPage = $vars['filename'] ?? '';
    $action = $_GET['action'] ?? '';
    
    // Try to get ID from $_GET['id'] first, then from 'rp' parameter (friendly URLs)
    $invoiceId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    
    $debugOutput .= "<script>console.log('Guest Invoice Hook: rp param = " . ($_GET['rp'] ?? 'NOT SET') . "');</script>";
    
    // If no ID from $_GET, try to extract from 'rp' parameter (e.g., ?rp=/hub/billing/invoice/68)
    if ($invoiceId === 0 && isset($_GET['rp'])) {
        $rp = $_GET['rp'];
        $debugOutput .= "<script>console.log('Guest Invoice Hook: rp value = $rp');</script>";
        if (preg_match('/\/invoice\/(\d+)/', $rp, $matches)) {
            $invoiceId = (int)$matches[1];
            $debugOutput .= "<script>console.log('Guest Invoice Hook: Extracted ID from rp: $invoiceId');</script>";
        } else {
            $debugOutput .= "<script>console.log('Guest Invoice Hook: regex did not match rp');</script>";
        }
    }
    
    // Also try to extract from REQUEST_URI directly (e.g., /invoices.php?id=68 or /billing/invoice/68)
    if ($invoiceId === 0 && preg_match('/[?&]id=(\d+)/', $requestUri, $matches)) {
        $invoiceId = (int)$matches[1];
    }
    
    // Detect invoice page via URL pattern (handles both regular and friendly URLs)
    $isInvoicePage = (strpos($requestUri, 'invoices.php') !== false && $action === 'edit' && $invoiceId > 0) 
                   || (preg_match('/\/invoices\/\d+/', $requestUri) && $invoiceId > 0)
                   || (preg_match('/billing\/invoice\/\d+/', $requestUri) && $invoiceId > 0)  // Friendly URL pattern - matches /hub/billing/invoice/68
                   || (preg_match('/[?&]id=\d+/', $requestUri) && strpos($requestUri, 'invoice') !== false && $invoiceId > 0);
    
    $debugOutput .= "<script>console.log('Guest Invoice Hook: URI=$requestUri, Page=$currentPage, Action=$action, ID=$invoiceId, IsInvoice=$isInvoicePage');</script>";
    
    if (!$isInvoicePage || $invoiceId === 0) {
        return $debugOutput . '<script>console.log("Guest Invoice Hook: Not on invoice page or no ID found");</script>';
    }
    
    // Get invoice data to verify it exists and get client ID
    $invoiceData = localAPI('GetInvoice', array('invoiceid' => $invoiceId));
    
    $debugOutput .= "<script>console.log('Guest Invoice Hook: Invoice data: " . json_encode($invoiceData) . "');</script>";
    
    if (!isset($invoiceData['userid']) || empty($invoiceData['userid'])) {
        return $debugOutput . '<script>console.log("Guest Invoice Hook: No client ID found");</script>';
    }
    
    $clientId = $invoiceData['userid'];
    
    // Encrypt client ID
    $clientResult = localAPI('EncryptPassword', array('password2' => $clientId));
    if (!isset($clientResult['password'])) {
        return '';
    }
    $encryptedClientId = rawurlencode($clientResult['password']);
    
    // Encrypt invoice ID
    $invoiceResult = localAPI('EncryptPassword', array('password2' => $invoiceId));
    if (!isset($invoiceResult['password'])) {
        return '';
    }
    $encryptedInvoiceId = rawurlencode($invoiceResult['password']);
    
    // Generate expiry time
    $expiryHours = Capsule::table('tbladdonmodules')
        ->where('module', 'guest_invoice_module')
        ->where('setting', 'expiry_time')
        ->value('value') ?: 24;
    
    $expiryTime = time() + ($expiryHours * 3600);
    $expiryResult = localAPI('EncryptPassword', array('password2' => $expiryTime));
    if (!isset($expiryResult['password'])) {
        return '';
    }
    $encryptedExpiry = rawurlencode($expiryResult['password']);
    
    // Build the guest invoice link
    $whmcsBaseUrl = Capsule::table('tblconfiguration')->where('setting', 'SystemURL')->value('value');
    $whmcsBaseUrl = rtrim($whmcsBaseUrl, '/') . '/';
    
    $guestLink = $whmcsBaseUrl
        . 'index.php?m=guest_invoice_module'
        . '&clientid=' . $encryptedClientId
        . '&invoiceid=' . $encryptedInvoiceId
        . '&expi=' . $encryptedExpiry
        . '&guestuser=true';
    
// Return debug output + JavaScript - SIMPLIFIED VERSION
    $guestLinkEscaped = htmlspecialchars($guestLink, ENT_QUOTES, 'UTF-8');
    
    return $debugOutput . <<<HTML
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log("Guest Invoice Hook: DOM ready");
    
    setTimeout(function() {
        var link = '{$guestLinkEscaped}';
        console.log("Guest Invoice Hook: Link ready");
        
        // Find button container
        var container = null;
        var selectors = [
            '.content-header .btn-group',
            '.card-header .btn-group',
            '.header .btn-group', 
            '.btn-toolbar',
            '.btn-group',
            '.float-right'
        ];
        
        for (var i = 0; i < selectors.length; i++) {
            var found = document.querySelector(selectors[i]);
            if (found) {
                container = found;
                console.log("Guest Invoice Hook: Found container: " + selectors[i]);
                break;
            }
        }
        
        // Fallback: find by button text
        if (!container) {
            var buttons = document.querySelectorAll('a, button');
            for (var j = 0; j < buttons.length; j++) {
                var text = buttons[j].textContent || buttons[j].innerText;
                if (text && (text.indexOf('Manage') !== -1 || text.indexOf('View') !== -1)) {
                    container = buttons[j].parentElement;
                    if (container) {
                        console.log("Guest Invoice Hook: Found container by button text");
                        break;
                    }
                }
            }
        }
        
        if (!container) {
            console.log("Guest Invoice Hook: No container found");
            return;
        }
        
        // Create button
        var btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'btn btn-default btn-sm';
        btn.style.marginLeft = '5px';
        btn.innerHTML = '<i class="fas fa-link"></i> Guest Invoice Link';
        btn.setAttribute('data-link', link);
        
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            var guestLink = this.getAttribute('data-link');
            console.log("Guest Invoice Hook: Clicked, link:", guestLink);
            
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(guestLink).then(function() {
                    alert('Guest invoice link copied to clipboard!');
                }).catch(function() {
                    fallbackCopy(guestLink);
                });
            } else {
                fallbackCopy(guestLink);
            }
        });
        
        function fallbackCopy(text) {
            var tempInput = document.createElement('input');
            document.body.appendChild(tempInput);
            tempInput.value = text;
            tempInput.select();
            try {
                document.execCommand('copy');
                alert('Guest invoice link copied to clipboard!');
            } catch (err) {
                prompt('Copy this link:', text);
            }
            document.body.removeChild(tempInput);
        }
        
        container.appendChild(btn);
        console.log("Guest Invoice Hook: Button added!");
        
    }, 1000);
});
</script>
<style>
    /* Additional styling if needed */
    .btn-group .btn:contains("Guest Invoice Link") {
        margin-left: 5px;
    }
</style>
HTML;
});
