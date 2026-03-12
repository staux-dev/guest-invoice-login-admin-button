# Guest Invoice Admin Hook

> **⚠️ Important**: This is an open-source complementary hook for the commercial Guest Invoice Module from WHMPress. **I am not the owner of the original module** - this project only enhances the user experience of the existing module.

## 📋 About

### The Problem
The WHMPress Guest Invoice Module is excellent and allows clients to pay invoices without needing to login. However, the administrator workflow has a limitation:

**Current workflow (problematic)**:
1. Administrator accesses invoice in admin panel
2. Clicks "View as Client" to view as client
3. Waits for page to load in client area
4. Searches for "Guest Invoice Link" button
5. Manually copies the link
6. Sends link to client (WhatsApp, email, etc.)

**Identified problems**:
- ⏱️ **Time waste**: Multiple clicks and page loads
- 🔄 **Context switch**: Administrator needs to leave admin panel
- 🐛 **Broken links**: Clients report white screens when accessing
- 📱 **Poor UX**: Workflow not optimized for quick support

### The Solution
This hook eliminates these problems by adding the button directly to the admin page:

**New workflow (optimized)**:
1. Administrator accesses invoice in admin panel 
2. Clicks "Guest Invoice Link" (it's on the same page) 
3. Link is automatically copied 
4. Send immediately to client 

**Achieved benefits**:
- ⚡ **80% faster**: From 5-6 steps to 2 steps
- 🎯 **No context switching**: Stays in admin panel
- 🔗 **Always working links**: Generated at the right time
- 📈 **Productivity**: Improves support team workflow

## 🏆 Why this hook exists

### Main Motivation
As a developer who works with WHMCS daily, I identified that support teams were wasting significant time copying guest invoice links. The need to switch between admin and client areas, combined with reports of broken links, motivated the creation of this solution.

### Contribution to the Community
This project is **open-source** and free because:
- 🤝 **Mutual aid**: Other developers may have the same problem
- 📚 **Knowledge sharing**: Sharing knowledge about WHMCS hooks
- 🔄 **Continuous improvement**: Community can contribute with improvements
- 💡 **Innovation**: Inspires other solutions for the WHMCS ecosystem

### Acknowledgments
- **WHMPress**: For creating the excellent Guest Invoice Module that serves as base
- **WHMCS**: For providing the platform and robust hook system
- **WHMCS Community**: For sharing knowledge and experiences

## ✨ Features

- **Automatic link generation**: Creates secure guest access links with encryption
- **Copy to Clipboard**: One-click button to copy link to clipboard
- **Short, WhatsApp-friendly link**: Copies a clean short URL that redirects to the full module link
- **Full compatibility**: Works with WHMCS friendly URLs and traditional URLs
- **Update-proof**: Installed as WHMCS global hook, not lost when updating module
- **Integrated debug**: Detailed console logs for troubleshooting
- **Responsive design**: Button with consistent styling with WHMCS

## 🚀 Installation

### Requirements
- WHMCS 7.0+ 
- WHMPress Guest Invoice Module installed and active
- Administrative access to WHMCS

### Steps

1. **Download the hook file**:
   ```bash
   # Copy guest-invoice-login-admin-button.php to your computer
   ```

2. **Upload the hook to WHMCS**:
   ```bash
   # Upload to: /includes/hooks/guest-invoice-login-admin-button.php
   ```

3. **Upload the redirect endpoint to WHMCS root**:
   ```bash
   # Upload to: /gi.php  (same directory where init.php exists)
   ```

4. **Verify installation**:
   - Access any invoice in admin: `/admin/invoices.php?action=edit&id=XX`
   - Open browser console (F12)
   - Look for logs: `Guest Invoice Hook: Hook executing...`
   - Button should appear near "Manage Invoice", "View as Client" buttons
   - Click the button and verify the copied link looks like: `https://yourdomain.tld/gi.php?code=XXXXXXXXXXXX`

## 🔧 Configuration

### Expiration Time
Link expiration time is configured in Guest Invoice Module settings:

1. Go to: **Setup → Addon Modules → Guest Invoice Module → Configure**
2. Configure **Link Expiry Time** (in hours)
3. Default: 336 hours (14 days)

### Debug
To enable detailed logging:
- Open browser console (F12 → Console)
- Logs appear automatically when accessing invoice pages

## 📸 Screenshots

### Before
*Administrator needs to click on "View as Client", wait for the page to load, find the button, and copy the link*

### After  
*Button "Guest Invoice Link" appears directly on the invoice edit page*

## 🐛 Troubleshooting

### Button doesn't appear
1. Check if you're on the correct page: `/admin/invoices.php?action=edit&id=XX`
2. Open console (F12) and look for errors
3. Confirm Guest Invoice Module is active
4. Check if file is in correct location: `/includes/hooks/`

### Link doesn't work
1. Check if expiration time hasn't expired
2. Confirm client associated with invoice exists
3. Verify SSO is enabled in WHMCS
4. Confirm `gi.php` is accessible at: `https://yourdomain.tld/gi.php` (should not be 404)

### Optional: Pretty URLs (no gi.php in the link)
The default short link format does not require any web server changes:
- `https://yourdomain.tld/gi.php?code=XXXXXXXXXXXX`

If you want a pretty URL like:
- `https://yourdomain.tld/client-name-123-2026-03-12-XXXXXXXXXXXX`

Add an Apache rewrite rule **above** the WHMCS rewrite block:
```apache
RewriteRule ^([a-z0-9-]+-[A-Za-z0-9_-]{6,32})$ gi.php?slug=$1 [L,QSA,NC]
```

### Console errors
- **"Guest Invoice Hook: Not on invoice page"**: You're not on invoice edit page
- **"Guest Invoice Hook: No client ID found"**: Invoice without associated client
- **"Guest Invoice Hook: No container found"**: HTML structure not recognized (old WHMCS version)

## 🔄 Compatibilidade

| WHMCS Versão | Compatível | Observações |
|---------------|------------|-------------|
| 7.0 - 8.0 | ✅ | Testado e funcionando |
| 8.1 - 8.5 | ✅ | Compatível com friendly URLs |
| 8.6+ | ✅ | Testado com tema Six e Twenty-One |

## 📝 Changelog

### v1.0.0 (2026-03-11)
- ✨ Versão inicial
- 🎯 Botão "Guest Invoice Link" na página admin
- 🔐 Geração automática de links encriptados
- 📋 Copy to clipboard functionality
- 🐛 Debug integrado
- 🌐 Suporte para URLs amigáveis

## 📄 Licença e Termos

### ⚠️ Disclaimer Importante
- **NÃO SOU O PROPRIETÁRIO** do Guest Invoice Module original
- Este é um **hook complementar** de código aberto
- **Requer licença válida** do módulo WHMPress original para funcionar
- **Uso comercial** do módulo original está sujeito aos termos da WHMPress

### 🏗️ Relação com o Módulo Original
| Aspecto | Módulo WHMPress | Este Hook |
|---------|----------------|-----------|
| **Propriedade** | WHMPress | Código aberto |
| **Licença** | Comercial | MIT |
| **Função** | Gera links de guest | Melhora UX admin |
| **Dependência** | Independente | Requer módulo |
| **Instalação** | Módulo completo | Hook simples |

### 📜 Termos de Uso
✅ **Permitido**:
- Uso com licença válida do módulo WHMPress
- Modificação para suas necessidades
- Distribuição com atribuição adequada
- Contribuição para o projeto

❌ **Proibido**:
- Vender este hook como produto separado
- Remover atribuições
- Usar sem licença do módulo original
- Claim de propriedade intelectual sobre o módulo base

## 🤝 Contribuição

Contribuições são bem-vindas! Por favor:

1. Faça fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/amazing-feature`)
3. Commit suas mudanças (`git commit -m 'Add amazing feature'`)
4. Push para a branch (`git push origin feature/amazing-feature`)
5. Abra um Pull Request

## 📞 Suporte

Para suporte do módulo original Guest Invoice Module:
- **WHMPress**: https://whmpress.com/
- **Documentação**: https://docs.whmpress.com/

Para suporte deste hook:
- **Issues**: Reporte problemas na documentação
- **Debug**: Use o console do navegador para troubleshooting

## 🏆 Créditos

- **WHMPress** - Criador do Guest Invoice Module original
- **WHMCS** - Plataforma de gestão de hosting

---

**Nota**: Este hook não afeta o funcionamento do módulo original. É uma camada adicional para melhorar a experiência administrativa.
