param (
    [string]$ProjectName
)

$ErrorActionPreference = "Stop"

# Configurações do Git
$gitUserName = "Staux.Dev"
$gitUserEmail = "tools@staux.dev"

if (-not $ProjectName) {
    Write-Error "O parâmetro -ProjectName é obrigatório. Ex: 'Cris Sato'"
    exit 1
}

$onedriveRoot = "c:\Users\taume\OneDrive\_STAUX\Projetos\Sites"
$boilerplatePath = Join-Path $onedriveRoot "_boilerplate"
$projectPath = Join-Path $onedriveRoot $ProjectName

Write-Host "--- Iniciando setup para '$ProjectName' ---" -ForegroundColor Cyan

# 1. Duplicar boilerplate
Write-Host "[1/3] Duplicando boilerplate..." -ForegroundColor Yellow
if (Test-Path $projectPath) {
    Write-Host "  - Pasta do projeto já existe em: $projectPath" -ForegroundColor Yellow
} else {
    try {
        Copy-Item $boilerplatePath -Destination $projectPath -Recurse
        Write-Host "  + Boilerplate duplicado para: $projectPath"
    } catch {
        Write-Host "  ! Erro ao duplicar boilerplate: $_" -ForegroundColor Red
        exit 1
    }
}

# 2. Configurar Git
Write-Host "[2/3] Configurando Git..." -ForegroundColor Yellow
$gitPath = Join-Path $projectPath ".git"
if (-not (Test-Path $gitPath)) {
    try {
        Set-Location $projectPath
        git init
        git config user.name $gitUserName
        git config user.email $gitUserEmail

        Write-Host "  + Repositório Git inicializado."
    } catch {
        Write-Host "  ! Erro ao inicializar Git: $_" -ForegroundColor Red
    }
} else {
    Write-Host "  - Git já inicializado."
}

# 3. Configurar .vscode
Write-Host "[3/3] Configurando VS Code..." -ForegroundColor Yellow
$vscodePath = Join-Path $projectPath ".vscode"
if (-not (Test-Path $vscodePath)) {
    New-Item -ItemType Directory -Path $vscodePath | Out-Null
}

$settingsSource = Join-Path $boilerplatePath "vscode-settings.json"
if (Test-Path $settingsSource) {
    Copy-Item $settingsSource (Join-Path $vscodePath "settings.json") -Force
    Write-Host "  + Arquivo .vscode/settings.json configurado."
}

# 4. Commit Inicial
Write-Host "[4/3] Realizando commit inicial..." -ForegroundColor Yellow
try {
    Set-Location $projectPath
    git add .
    git commit -m "Initial commit: Projeto $ProjectName configurado via Automação"
    Write-Host "  + Commit inicial realizado com sucesso."
} catch {
    Write-Host "  ! Erro ao realizar commit: $_" -ForegroundColor Red
}

Write-Host "`n--- Setup Concluído! ---" -ForegroundColor Green
Write-Host "Pasta do Projeto: $projectPath"
Write-Host "`nPróximos passos:"
Write-Host "  1. Abra a pasta no VS Code"
Write-Host "  2. Coloque a logo do cliente em: tema/assets/logo.webp"
Write-Host "  3. Coloque materiais do cliente em: blueprint/cliente/"
Write-Host "  4. Envie o Prompt Mestre ao Claude Code"
