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

## 🔄 Compatibility

| WHMCS Version | Compatible | Notes |
|---------------|------------|------|
| 7.0 - 8.0 | ✅ | Tested and working |
| 8.1 - 8.5 | ✅ | Compatible with friendly URLs |
| 8.6+ | ✅ | Tested with Six and Twenty-One themes |

## 📝 Changelog

### v1.0.0 (2026-03-11)
- ✨ Initial release
- 🎯 "Guest Invoice Link" button on the admin invoice page
- 🔐 Automatic generation of encrypted guest access links
- 📋 Copy to clipboard functionality
- 🐛 Integrated debug logs
- 🌐 Support for friendly URLs

## 📄 License and Terms

### ⚠️ Important Disclaimer
- **I AM NOT THE OWNER** of the original Guest Invoice Module
- This is an **open-source complementary hook**
- **Requires a valid license** for the original WHMPress module to work
- **Commercial usage** of the original module is subject to WHMPress terms

### 🏗️ Relationship with the Original Module
| Aspect | WHMPress Module | This Hook |
|--------|------------------|-----------|
| **Ownership** | WHMPress | Open source |
| **License** | Commercial | MIT |
| **Purpose** | Generates guest links | Improves admin UX |
| **Dependency** | Standalone | Requires module |
| **Installation** | Full module | Simple hook |

### 📜 Terms of Use
✅ **Allowed**:
- Use with a valid license of the WHMPress module
- Modify for your needs
- Distribute with proper attribution
- Contribute to the project

❌ **Not allowed**:
- Sell this hook as a standalone product
- Remove attributions
- Use without a valid license for the original module
- Claim intellectual property over the original module

## 🤝 Contributing

Contributions are welcome. Please:

1. Fork the project
2. Create a branch for your feature (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📞 Support

For support of the original Guest Invoice Module:
- **WHMPress**: https://whmpress.com/
- **Documentation**: https://docs.whmpress.com/

For support of this hook:
- **Issues**: Report issues in the repository
- **Debug**: Use the browser console for troubleshooting

## 🏆 Credits

- **WHMPress** - Creator of the original Guest Invoice Module
- **WHMCS** - Hosting management platform

---

**Note**: This hook does not affect the original module behavior. It is an additional layer to improve the admin experience.
