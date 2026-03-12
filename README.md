# Guest Invoice Admin Hook

> **⚠️ Importante**: Este é um hook complementar de código aberto para o módulo comercial Guest Invoice Module da WHMPress. **Não sou o proprietário do módulo original** - este projeto apenas melhora a experiência de uso do módulo existente.

## 📋 Sobre

### O Problema
O módulo Guest Invoice Module da WHMPress é excelente e permite que clientes paguem invoices sem precisar fazer login. No entanto, o fluxo de trabalho para administradores tem uma limitação:

**Fluxo atual (problemático)**:
1. Administrador acessa invoice no painel admin
2. Clica em "View as Client" para visualizar como cliente
3. Espera a página carregar na área do cliente
4. Procura pelo botão "Guest Invoice Link"
5. Copia o link manualmente
6. Envie o link ao cliente (WhatsApp, email, etc.)

**Problemas identificados**:
- ⏱️ **Perda de tempo**: Múltiplos cliques e carregamentos de página
- 🔄 **Context switch**: Administrador precisa sair do painel admin
- 🐛 **Links quebrados**: Clientes reportam telas brancas ao acessar
- � **UX ruim**: Fluxo não otimizado para suporte rápido

### A Solução
Este hook elimina esses problemas adicionando o botão diretamente na página admin:

**Novo fluxo (otimizado)**:
1. Administrador acessa invoice no painel admin ✅
2. Clica em "Guest Invoice Link" (está na mesma página) ✅
3. Link é copiado automaticamente ✅
4. Envie imediatamente ao cliente ✅

**Benefícios alcançados**:
- ⚡ **80% mais rápido**: De 5-6 passos para 2 passos
- 🎯 **Sem mudança de contexto**: Fica no painel admin
- 🔗 **Links sempre funcionais**: Gerados na hora correta
- 📈 **Produtividade**: Melhora fluxo de equipes de suporte

## 🏆 Por que este hook existe

### Motivação Principal
Como desenvolvedor que trabalha com WHMCS diariamente, identifiquei que equipes de suporte perdiam tempo significativo copiando links de guest invoices. A necessidade de alternar entre admin e área do cliente, somada a relatos de links quebrados, motivou a criação desta solução.

### Contribuição para a Comunidade
Este projeto é **código aberto** e gratuito porque:
- 🤝 **Ajuda mútua**: Outros desenvolvedores podem ter o mesmo problema
- 📚 **Aprendizado**: Compartilhamento de conhecimento sobre hooks WHMCS
- 🔄 **Melhoria contínua**: Comunidade pode contribuir com melhorias
- 💡 **Inovação**: Inspira outras soluções para o ecossistema WHMCS

### Agradecimentos
- **WHMPress**: Por criar o excelente Guest Invoice Module que serve de base
- **WHMCS**: Por fornecer a plataforma e sistema de hooks robusto
- **Comunidade WHMCS**: Por compartilhar conhecimento e experiências

## ✨ Funcionalidades

- **Geração automática de links**: Cria links de acesso convidado seguros com criptografia
- **Copy to Clipboard**: Botão com um clique para copiar o link para área de transferência
- **Compatibilidade total**: Funciona com URLs amigáveis e URLs tradicionais do WHMCS
- **Sobrevive a atualizações**: Instalado como hook global do WHMCS, não é perdido ao atualizar o módulo
- **Debug integrado**: Logs detalhados no console para troubleshooting
- **Design responsivo**: Botão com estilo consistente com o WHMCS

## 🚀 Instalação

### Requisitos
- WHMCS 7.0+ 
- Guest Invoice Module da WHMPress instalado e ativo
- Acesso administrativo ao WHMCS

### Passos

1. **Baixe o arquivo hook**:
   ```bash
   # Copie o arquivo guest_invoice_admin_hook.php para seu computador
   ```

2. **Faça upload para o WHMCS**:
   ```bash
   # Envie para: /includes/hooks/guest_invoice_admin_hook.php
   ```

3. **Verifique a instalação**:
   - Acesse qualquer invoice no admin: `/admin/invoices.php?action=edit&id=XX`
   - Abra o console do navegador (F12)
   - Procure pelos logs: `Guest Invoice Hook: Hook executing...`
   - O botão deve aparecer próximo aos botões "Manage Invoice", "View as Client"

## 🔧 Configuração

### Tempo de Expiração
O tempo de expiração dos links é configurado nas configurações do módulo Guest Invoice Module:

1. Acesse: **Setup → Addon Modules → Guest Invoice Module → Configure**
2. Configure **Link Expiry Time** (em horas)
3. Padrão: 336 horas (14 dias)

### Debug
Para habilitar logs detalhados:
- Abra o console do navegador (F12 → Console)
- Os logs aparecem automaticamente quando acessa uma página de invoice

## 📸 Screenshots

### Antes
*Administrador precisa clicar em "View as Client", esperar carregar, encontrar o botão e copiar o link*

### Depois  
*Botão "Guest Invoice Link" aparece diretamente na página de edição da invoice*

## 🐛 Troubleshooting

### Botão não aparece
1. Verifique se está na página correta: `/admin/invoices.php?action=edit&id=XX`
2. Abra o console (F12) e procure por erros
3. Confirme se o módulo Guest Invoice Module está ativo
4. Verifique se o arquivo está no local correto: `/includes/hooks/`

### Link não funciona
1. Verifique se o tempo de expiração não expirou
2. Confirme se o cliente associado à invoice existe
3. Verifique se o SSO está habilitado no WHMCS

### Erros no console
- **"Guest Invoice Hook: Not on invoice page"**: Você não está na página de edição de invoice
- **"Guest Invoice Hook: No client ID found"**: Invoice sem cliente associado
- **"Guest Invoice Hook: No container found"**: Estrutura HTML não reconhecida (versão antiga do WHMCS)

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
