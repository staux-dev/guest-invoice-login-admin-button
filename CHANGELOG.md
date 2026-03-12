# Changelog

All notable changes to the Guest Invoice Admin Hook will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2026-03-11

### Added
- ✨ Initial release of Guest Invoice Admin Hook
- 🎯 "Guest Invoice Link" button on admin invoice edit page
- 🔐 Automatic generation of encrypted guest access links
- 📋 One-click copy to clipboard functionality
- 🐛 Integrated debug logging for troubleshooting
- 🌐 Full support for WHMCS friendly URLs and traditional URLs
- 🎨 Consistent styling with WHMCS admin interface
- ⚡ Vanilla JavaScript implementation (no jQuery dependency)
- 🔍 Smart container detection for different WHMCS themes
- 🛡️ Link expiration handling based on module settings
- 📱 Responsive button design

### Features
- **Smart URL Detection**: Works with both `/admin/invoices.php?action=edit&id=XX` and friendly URLs like `/hub/index.php?rp=/hub/billing/invoice/XX`
- **Multi-Theme Support**: Compatible with WHMCS Six, Twenty-One and custom themes
- **Fallback Mechanisms**: Multiple container detection strategies for different page layouts
- **Secure Link Generation**: Uses WHMCS `EncryptPassword` API for security
- **Session Management**: Integrates with existing guest session handling

### Technical Details
- **Hook Type**: `AdminAreaHeadOutput`
- **Dependencies**: Guest Invoice Module (WHMPress)
- **Compatibility**: WHMCS 7.0+
- **Installation**: Global hook at `/includes/hooks/`
- **Debug**: Console logging with detailed information

### Security
- ✅ Uses WHMCS built-in encryption APIs
- ✅ Respects module expiration settings
- ✅ Validates invoice and client permissions
- ✅ Safe JavaScript implementation with proper escaping

### Performance
- ⚡ Minimal impact on page load time
- 🎯 Executes only on invoice edit pages
- 🔄 Efficient DOM queries with fallback strategies
- 📦 Small footprint (~5KB)

---

## [Unreleased]

### Planned Features
- 🌐 Multi-language support for button text
- 🎨 Customizable button styling options
- 📊 Usage statistics and analytics
- 🔧 Admin configuration panel
- 📧 Email integration for sharing links
- 📱 Mobile app compatibility

### Potential Improvements
- 🔄 Auto-refresh of expired links
- 📋 Batch link generation for multiple invoices
- 🔍 Search and filter functionality
- 🎯 Link tracking and usage monitoring

---

## Version History

| Version | Date | Changes | Status |
|---------|------|---------|--------|
| 1.0.0 | 2026-03-11 | Initial release | ✅ Stable |
| 0.9.0 | 2026-03-11 | Beta testing phase | ✅ Tested |
| 0.1.0 | 2026-03-11 | Development started | ✅ Complete |

---

## Migration Guide

### From v0.x to v1.0.0
No migration required - this is the initial stable release.

### Breaking Changes
None in v1.0.0 - backward compatible with all beta versions.

---

## Known Issues

### v1.0.0
- 🐛 None reported

### Fixed Issues
- ✅ Fixed jQuery dependency issues
- ✅ Fixed friendly URL detection
- ✅ Fixed JavaScript syntax errors
- ✅ Fixed container detection in different themes

---

## Support Matrix

| WHMCS Version | 1.0.0 | Notes |
|---------------|-------|-------|
| 7.0 - 7.7 | ✅ | Full support |
| 8.0 - 8.5 | ✅ | Including friendly URLs |
| 8.6+ | ✅ | Latest versions tested |

| PHP Version | 1.0.0 | Notes |
|-------------|-------|-------|
| 7.2+ | ✅ | Minimum requirement |
| 8.0+ | ✅ | Fully compatible |
| 8.1+ | ✅ | Tested and working |

---

## Dependencies

### Required
- WHMCS 7.0+
- Guest Invoice Module (WHMPress)
- PHP 7.2+

### Optional
- Modern browser with clipboard API support
- FontAwesome for icons (fallback to text)

---

## Security Patches

This section will be updated if any security vulnerabilities are discovered and patched.

---

## Contributing to Changelog

When contributing to this project:
1. Add changes to the "Unreleased" section
2. Use proper semantic versioning
3. Follow the established format
4. Include breaking changes notice if applicable
5. Update support matrix if needed

---

*Last updated: 2026-03-11*
