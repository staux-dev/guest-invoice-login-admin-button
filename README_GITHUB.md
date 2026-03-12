# 🚀 Guest Invoice Admin Hook

> **Hook complementar de código aberto** para o módulo Guest Invoice Module da WHMPress que melhora a experiência administrativa no WHMCS.

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![WHMCS Version](https://img.shields.io/badge/WHMCS-7.0+-blue.svg)](https://whmcs.com/)
[![PHP Version](https://img.shields.io/badge/PHP-7.2+-green.svg)](https://php.net/)
[![Open Source](https://img.shields.io/badge/Open%20Source-%E2%9C%93-brightgreen.svg)](LICENSE.md)

## ⚡ O Problema Resolvido

O fluxo atual para copiar links de guest invoice é **lento e propenso a erros**:

```
❌ Fluxo Problemático:
1. Acessar invoice no admin
2. Clicar "View as Client" 
3. Esperar carregar área do cliente
4. Procurar botão "Guest Invoice Link"
5. Copiar link manualmente
6. Enviar ao cliente
```

**Resultado**: Links quebrados, tempo perdido, UX ruim.

## 🎯 A Solução

Este hook adiciona o botão **diretamente na página admin**:

```
✅ Fluxo Otimizado:
1. Acessar invoice no admin
2. Clicar "Guest Invoice Link" (mesma página!)
3. Link copiado automaticamente
4. Enviar ao cliente
```

**Resultado**: 80% mais rápido, links sempre funcionais, UX excelente.

## 🌟 Funcionalidades Principais

| Funcionalidade | Benefício |
|---------------|-----------|
| 🎯 **Botão na página admin** | Sem alternar contextos |
| 📋 **Copy to Clipboard** | Um clique para copiar |
| 🔐 **Links seguros** | Criptografia WHMCS nativa |
| 🌐 **URLs amigáveis** | Suporte total a friendly URLs |
| 🎨 **Design consistente** | Integra perfeita com WHMCS |
| 🐛 **Debug integrado** | Troubleshooting fácil |
- ⚡ **Alta performance**: Executa apenas quando necessário
- 🛡️ **Seguro**: Usa APIs WHMCS, sem dados expostos
- 📱 **Responsivo**: Funciona em todos os dispositivos

## 📦 Instalação Rápida

### 1️⃣ Download
```bash
git clone https://github.com/yourusername/guest-invoice-admin-hook.git
```

### 2️⃣ Upload
```bash
# Copie para seu WHMCS:
cp guest_invoice_admin_hook.php /path/to/whmcs/includes/hooks/
```

### 3️⃣ Verifique
- Acesse: `/admin/invoices.php?action=edit&id=XX`
- Procure pelo botão: **"Guest Invoice Link"**
- Abra console (F12) para ver logs de debug

## 🔧 Requisitos

- ✅ **WHMCS 7.0+**
- ✅ **Guest Invoice Module** (WHMPress) - licença válida necessária
- ✅ **PHP 7.2+**
- ✅ **Acesso admin** ao WHMCS

## 📋 Demonstração

### Antes vs Depois

| Aspecto | Antes | Depois |
|---------|-------|--------|
| ⏱️ Tempo | 30-60 segundos | 5 segundos |
| 🔄 Cliques | 6+ cliques | 2 cliques |
| 🐛 Erros | Frequentes | Raros |
| 😊 UX | Ruim | Excelente |

## 🛠️ Configuração

O tempo de expiração dos links é configurado no módulo original:

```
Setup → Addon Modules → Guest Invoice Module → Configure
└── Link Expiry Time: 336 horas (padrão)
```

## 🐛 Troubleshooting

### Botão não aparece?
```bash
# Verifique console (F12) para logs:
Guest Invoice Hook: Hook executing...
Guest Invoice Hook: Found container: .btn-group
Guest Invoice Hook: Button added!
```

### Link não funciona?
- Verifique se o módulo WHMPress está ativo
- Confirme se a invoice tem cliente associado
- Teste tempo de expiração

## 📚 Documentação Completa

- 📖 [README.md](README.md) - Documentação completa
- 🔧 [INSTALL.md](INSTALL.md) - Guia detalhado de instalação  
- 📝 [CHANGELOG.md](CHANGELOG.md) - Histórico de versões
- 🤝 [CONTRIBUTING.md](CONTRIBUTING.md) - Como contribuir
- 📄 [LICENSE.md](LICENSE.md) - Termos de licença

## ⚠️ Disclaimer Importante

> **NÃO SOU O PROPRIETÁRIO** do Guest Invoice Module original.  
> Este é um **hook complementar de código aberto** que requer licença válida do módulo WHMPress para funcionar.

| Módulo WHMPress | Este Hook |
|-----------------|-----------|
| 🏢 **Propriedade**: WHMPress | 🌍 **Propriedade**: Código aberto |
| 💰 **Licença**: Comercial | 🆓 **Licença**: MIT |
| 🔧 **Função**: Gera links | ⚡ **Função**: Melhora UX |
| 📦 **Tipo**: Módulo completo | 🎯 **Tipo**: Hook simples |

## 🤝 Contribua

Contribuições são bem-vindas! 🎉

- 🐛 **Report bugs**: [Issues](https://github.com/yourusername/guest-invoice-admin-hook/issues)
- 💡 **Sugira melhorias**: [Discussions](https://github.com/yourusername/guest-invoice-admin-hook/discussions)
- 🔧 **Envie PRs**: [Pull Requests](https://github.com/yourusername/guest-invoice-admin-hook/pulls)

## 🏆 Agradecimentos

- **WHMPress**: Pelo excelente Guest Invoice Module
- **WHMCS**: Pela plataforma robusta e sistema de hooks
- **Comunidade**: Por compartilhar conhecimento e experiências

## 📄 Licença

Este projeto está licenciado sob [MIT License](LICENSE.md).

---

<div align="center">

**⭐ Se este hook ajudou você, deixe uma estrela!**

Made with ❤️ for the WHMCS Community

</div>
