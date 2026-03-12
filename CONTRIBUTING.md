# Contributing to Guest Invoice Admin Hook

Obrigado pelo seu interesse em contribuir com o Guest Invoice Admin Hook! Este documento explica como você pode ajudar a melhorar este projeto.

## 🤝 Como Contribuir

### Reportando Issues
- Use o [GitHub Issues](https://github.com/yourusername/guest-invoice-admin-hook/issues) para reportar bugs
- Forneça detalhes: WHMCS versão, navegador, erro exato
- Inclua screenshots se aplicável
- Verifique se o issue já não foi reportado

### Enviando Pull Requests
1. **Fork** o repositório
2. **Clone** seu fork: `git clone https://github.com/yourusername/guest-invoice-admin-hook.git`
3. **Crie** uma branch: `git checkout -b feature/nova-funcionalidade`
4. **Faça** suas mudanças
5. **Teste** thoroughly
6. **Commit**: `git commit -m 'Add nova funcionalidade'`
7. **Push**: `git push origin feature/nova-funcionalidade`
8. **Abra** um Pull Request

## 📋 Tipos de Contribuições

### 🐛 Bug Fixes
- Correção de erros de JavaScript
- Melhorias na detecção de containers
- Correção de compatibilidade com temas
- Fix de problemas com URLs amigáveis

### ✨ Novas Funcionalidades
- Suporte para múltiplos idiomas
- Opções de customização visual
- Integração com outros módulos
- Melhorias na UX do botão

### 📚 Melhorias na Documentação
- Tradução para outros idiomas
- Melhorias nos guias de instalação
- Adição de exemplos de uso
- Correção de erros de digitação

### 🧪 Testes
- Testes de compatibilidade com diferentes versões do WHMCS
- Testes com diferentes temas (Six, Twenty-One, custom)
- Testes de performance
- Testes de segurança

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
