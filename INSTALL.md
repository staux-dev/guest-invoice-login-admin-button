# Installation Guide

## Guest Invoice Admin Hook Installation

This guide provides step-by-step instructions for installing the Guest Invoice Admin Hook for WHMCS.

## 📋 Prerequisites

### System Requirements
- **WHMCS**: Version 7.0 or higher
- **PHP**: Version 7.2 or higher  
- **Guest Invoice Module**: WHMPress Guest Invoice Module installed and active
- **Access**: Administrative access to WHMCS files and admin panel

### Browser Requirements (Recommended)
- **Chrome**: 80+ or **Firefox**: 75+ or **Safari**: 13+ or **Edge**: 80+
- **JavaScript**: Must be enabled
- **Clipboard API**: For copy functionality (fallback available)

---

## 🚀 Quick Installation (5 Minutes)

### Step 1: Download the Files
```bash
# Download:
# - guest-invoice-login-admin-button.php (hook)
# - gi.php (public redirect endpoint)
```

### Step 2: Upload to WHMCS
```bash
# Upload to your WHMCS installation:
# /includes/hooks/guest-invoice-login-admin-button.php
# /gi.php  (WHMCS root, same directory where init.php exists)
```

### Step 3: Verify Installation
1. Log into WHMCS admin panel
2. Navigate to any invoice: `/admin/invoices.php?action=edit&id=XX`
3. Open browser console (F12 → Console)
4. Look for: `Guest Invoice Hook: Hook executing...`
5. Confirm "Guest Invoice Link" button appears
6. Click the button and confirm the copied URL looks like: `https://yourdomain.tld/gi.php?code=XXXXXXXXXXXX`

---

## 📁 Detailed Installation

### Step 1: Locate Your WHMCS Installation

#### Method A: Via FTP/SFTP
```bash
# Connect to your server
# Navigate to WHMCS root directory
cd /path/to/whmcs/
```

#### Method B: Via cPanel File Manager
1. Login to cPanel
2. Open File Manager
3. Navigate to public_html (or your WHMCS directory)
4. Go to `includes/hooks/`

#### Method C: Via SSH
```bash
ssh user@yourserver.com
cd /var/www/html/whmcs/  # Adjust path as needed
```

### Step 2: Upload the Hook File

#### Option A: Upload via FTP/SFTP
```bash
# Upload guest-invoice-login-admin-button.php to:
# /path/to/whmcs/includes/hooks/guest-invoice-login-admin-button.php

# Upload gi.php to WHMCS root:
# /path/to/whmcs/gi.php
```

#### Option B: Create File Directly
```bash
# Create the file with proper permissions
touch /path/to/whmcs/includes/hooks/guest_invoice_admin_hook.php
chmod 644 /path/to/whmcs/includes/hooks/guest_invoice_admin_hook.php
```

#### Option C: Copy from Module Directory
```bash
# If you have the module files:
cp /path/to/module/guest_invoice_admin_hook.php /path/to/whmcs/includes/hooks/
```

### Step 3: Verify File Permissions
```bash
# Set appropriate permissions
chmod 644 /path/to/whmcs/includes/hooks/guest_invoice_admin_hook.php
chown www-data:www-data /path/to/whmcs/includes/hooks/guest_invoice_admin_hook.php  # Adjust user/group
```

---

## 🔧 Configuration

### Verify Guest Invoice Module Settings
1. Go to **Setup → Addon Modules → Guest Invoice Module**
2. Click **Configure**
3. Check **Link Expiry Time** (default: 336 hours)
4. Ensure module is **Active**

### Optional: Enable Debug Mode
The hook includes built-in debug logging. To view:
1. Open any invoice edit page
2. Open browser console (F12)
3. Look for logs starting with `Guest Invoice Hook:`

### Optional: Pretty URLs (no gi.php in the link)
The default short URL requires no web server configuration:
- `https://yourdomain.tld/gi.php?code=XXXXXXXXXXXX`

If you want a pretty URL like:
- `https://yourdomain.tld/client-name-123-2026-03-12-XXXXXXXXXXXX`

Add this Apache rule **above** the WHMCS rewrite block:
```apache
RewriteRule ^([a-z0-9-]+-[A-Za-z0-9_-]{6,32})$ gi.php?slug=$1 [L,QSA,NC]
```

---

## ✅ Verification Checklist

### Pre-Installation Checklist
- [ ] WHMCS version 7.0+ installed
- [ ] Guest Invoice Module active and configured
- [ ] Administrative access to WHMCS
- [ ] Backup of current hooks directory (optional)

### Post-Installation Checklist
- [ ] Hook uploaded to `/includes/hooks/guest-invoice-login-admin-button.php`
- [ ] `gi.php` uploaded to `/gi.php` (WHMCS root)
- [ ] File permissions set correctly (644)
- [ ] Hook appears in console logs
- [ ] Button displays on invoice edit pages
- [ ] Copy to clipboard functionality works
- [ ] Generated links work when accessed

---

## 🐛 Troubleshooting

### Common Issues

#### Issue 1: Button Not Visible
**Symptoms**: No button appears on invoice edit page
**Solutions**:
```bash
# Check file location
ls -la /path/to/whmcs/includes/hooks/guest-invoice-login-admin-button.php

# Check gi.php exists in WHMCS root
ls -la /path/to/whmcs/gi.php

# Check permissions
ls -la /path/to/whmcs/includes/hooks/

# Check console logs for errors
```

#### Issue 2: Console Shows "Not on invoice page"
**Symptoms**: Hook runs but doesn't detect invoice page
**Solutions**:
1. Verify URL format: `/admin/invoices.php?action=edit&id=XX`
2. Check for friendly URLs: `/hub/index.php?rp=/hub/billing/invoice/XX`
3. Ensure invoice ID exists and is valid

#### Issue 3: Link Generation Fails
**Symptoms**: Button appears but link doesn't work
**Solutions**:
1. Verify Guest Invoice Module is active
2. Check if client exists for the invoice
3. Verify WHMCS SSO is enabled

#### Issue 4: Copy to Clipboard Not Working
**Symptoms**: Clicking button doesn't copy link
**Solutions**:
1. Check browser compatibility
2. Ensure HTTPS is enabled (required for clipboard API)
3. Look for JavaScript errors in console

### Debug Mode
Enable detailed logging:
```javascript
// Open browser console (F12)
// Look for these specific logs:
- "Guest Invoice Hook: Hook executing..."
- "Guest Invoice Hook: URI=..."
- "Guest Invoice Hook: ID=..."
- "Guest Invoice Hook: IsInvoice=..."
- "Guest Invoice Hook: Found container..."
- "Guest Invoice Hook: Button added!"
```

---

## 🔄 Updates and Maintenance

### Updating the Hook
1. Download new version
2. Replace existing file: `/includes/hooks/guest-invoice-login-admin-button.php`
3. Replace `/gi.php` if provided in the release
3. Clear browser cache
4. Test functionality

### Removing the Hook
```bash
# Simply delete the file
rm /path/to/whmcs/includes/hooks/guest-invoice-login-admin-button.php
rm /path/to/whmcs/gi.php
```

### Backup Before Updates
```bash
# Create backup of hooks directory
cp -r /path/to/whmcs/includes/hooks/ /path/to/backup/hooks_backup_$(date +%Y%m%d)/
```

---

## 📊 Performance Impact

### Resource Usage
- **Memory**: < 1MB additional usage
- **CPU**: Minimal impact (executes only on invoice pages)
- **Network**: No additional requests
- **Storage**: ~5KB file size

### Optimization Tips
1. Enable WHMCS caching if not already enabled
2. Use modern browsers for better performance
3. Regular WHMCS updates ensure compatibility

---

## 🛡️ Security Considerations

### File Security
```bash
# Set secure permissions
chmod 644 /path/to/whmcs/includes/hooks/guest_invoice_admin_hook.php
chown www-data:www-data /path/to/whmcs/includes/hooks/guest_invoice_admin_hook.php
```

### Code Security
- ✅ Uses WHMCS built-in encryption APIs
- ✅ Validates all input parameters
- ✅ Respects user permissions
- ✅ No external dependencies
- ✅ Safe JavaScript implementation

### Best Practices
1. Regular WHMCS updates
2. Monitor WHMCS activity logs
3. Keep backup of custom hooks
4. Review hook permissions regularly

---

## 📞 Support Resources

### Documentation
- **README.md**: Complete feature documentation
- **CHANGELOG.md**: Version history and updates
- **WHMCS Documentation**: https://docs.whmcs.com/
- **WHMPress Support**: https://whmpress.com/support/

### Community
- **WHMCS Forums**: https://forum.whmcs.com/
- **WHMPress Documentation**: https://docs.whmpress.com/

### Getting Help
1. Check console logs for errors
2. Verify installation steps
3. Review troubleshooting section
4. Contact WHMCS support for platform issues
5. Contact WHMPress for module-specific issues

---

## 🎯 Next Steps

After successful installation:
1. Test with various invoice scenarios
2. Train staff on new functionality
3. Monitor for any issues
4. Consider customizing button text if needed
5. Set up regular backup procedures

---

*Last updated: 2026-03-11*
