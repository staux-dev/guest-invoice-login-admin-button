# Contributing to Guest Invoice Admin Hook

Thank you for your interest in contributing to the Guest Invoice Admin Hook! This document explains how you can help improve this project.

## 🤝 How to Contribute

### Reporting Issues
- Use [GitHub Issues](https://github.com/staux-dev/guest-invoice-login-admin-button/issues) to report bugs
- Provide details: WHMCS version, browser, exact error
- Include screenshots if applicable
- Check if the issue hasn't been reported already

### Submitting Pull Requests
1. **Fork** the repository
2. **Clone** your fork: `git clone https://github.com/yourusername/guest-invoice-login-admin-button.git`
3. **Create** a branch: `git checkout -b feature/amazing-feature`
4. **Make** your changes
5. **Test** thoroughly
6. **Commit**: `git commit -m 'Add amazing feature'`
7. **Push**: `git push origin feature/amazing-feature`
8. **Open** a Pull Request

## 📋 Types of Contributions

### 🐛 Bug Fixes
- JavaScript error corrections
- Container detection improvements
- Theme compatibility fixes
- Friendly URL issue fixes

### ✨ New Features
- Multi-language support
- Visual customization options
- Integration with other modules
- Button UX improvements

### 📚 Documentation Improvements
- Translations to other languages
- Installation guide improvements
- Usage examples addition
- Typo corrections

### 🧪 Testing
- Compatibility tests with different WHMCS versions
- Tests with different themes (Six, Twenty-One, custom)
- Performance tests
- Security tests

## 🎯 Diretrizes de Código

### PHP
- Siga PSR-12 para formatação
- Use type hints quando possível
- Comente código complexo
- Mantenha compatibilidade com PHP 7.2+

### JavaScript
- Use vanilla JavaScript (sem jQuery)
- Escreva código ES6+ compatível
- Handle erros gracefully
- Otimize performance

### CSS
- Use classes CSS consistentes com WHMCS
- Evite estilos inline (exceto quando necessário)
- Teste em diferentes navegadores
- Mantenha design responsivo

## 🔒 Diretrizes de Segurança

### ⚠️ IMPORTANTE
Este hook lida com dados sensíveis:
- IDs de clientes e invoices
- Tokens de acesso SSO
- Links de pagamento

### 👍 Boas Práticas
- Valide sempre os inputs
- Use WHMCS APIs para operações seguras
- Nunca exponha dados sensíveis no frontend
- Teste thoroughly para vulnerabilidades

### 🚫 Não Fazer
- Armazenar credenciais no código
- Bypass de validações do WHMCS
- Expor informações de clientes
- Modificar core do WHMCS

## 📝 Processo de Review

### Antes de Abrir PR
- [ ] Código segue as diretrizes
- [ ] Testado em múltiplas versões do WHMCS
- [ ] Documentação atualizada
- [ ] Sem conflitos de merge
- [ ] Commits descritivos

### Durante o Review
- Seja receptivo a feedback
- Responda aos comentários
- Faça ajustes solicitados
- Mantenha discussão profissional

### Após Merge
- Delete sua branch local
- Agradeça aos contribuidores
- Comemore sua contribuição! 🎉

## 🌍 Internacionalização

### Adicionando Novos Idiomas
1. Crie arquivo: `lang/pt_BR.php` (exemplo)
2. Adicione traduções:
```php
<?php
$_LANG['guest_invoice_link'] = 'Link de Fatura Convidado';
$_LANG['copy_success'] = 'Link copiado com sucesso!';
?>
```
3. Atualize o JavaScript para usar as variáveis
4. Teste thoroughly

### Idiomas Suportados Atualmente
- 🇧🇷 Português Brasileiro (padrão)
- 🇺🇸 English (planejado)
- 🇪🇸 Español (contributo bem-vindo)

## 🏆 Reconhecimento

### Contribuidores
- Todos os contribuidores serão listados no README
- Contribuições significativas receberão destaque
- Mantemos histórico de todas as contribuições

### Como Ser Reconhecido
- Contribuições de código (PRs mergeados)
- Report de bugs críticos
- Melhorias significativas na documentação
- Traduções completas

## 📞 Suporte para Contribuidores

### Dúvidas
- Abra uma issue com label "question"
- Participe das discussões
- Consulte a documentação existente

### Recursos
- [WHMCS Developer Documentation](https://developers.whmcs.com/)
- [WHMCS Hooks Documentation](https://developers.whmcs.com/hooks/)
- [WHMPress Documentation](https://docs.whmpress.com/)

## 🔄 Versionamento

### SemVer
Seguimos [Semantic Versioning](https://semver.org/):
- **MAJOR**: Mudanças que quebram compatibilidade
- **MINOR**: Novas funcionalidades (backward compatible)
- **PATCH**: Bug fixes e melhorias menores

### Release Process
1. Atualize CHANGELOG.md
2. Atualize versão no código
3. Crie release tag no GitHub
4. Anuncie nas issues/discussions

## ⚖️ Código de Conduta

### Nosso Compromisso
- Ser inclusivo e respeitoso
- Aceitar contribuições de todos
- Manter ambiente profissional
- Aprender uns com os outros

### Comportamento Esperado
- Linguagem respeitosa
- Feedback construtivo
- Paciência com iniciantes
- Foco no que é melhor para a comunidade

## 🎉 Obrigado!

Sua contribuição ajuda a melhorar a experiência de milhares de administradores WHMCS. Juntos construímos um ecossistema melhor!

---

**Lembre-se**: Este é um projeto complementar ao Guest Invoice Module da WHMPress. Respeite os termos de licença do módulo original e contribua de forma ética e construtiva.
