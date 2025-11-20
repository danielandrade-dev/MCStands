# 🚀 Guia Rápido de Deploy - Hospedagem Compartilhada

## Checklist de Deploy

### 1. Preparação Local
- [ ] Execute `composer install --no-dev --optimize-autoloader` para produção
- [ ] Verifique se todos os arquivos estão prontos
- [ ] Teste localmente antes de fazer upload

### 2. Upload para o Servidor
- [ ] Faça upload de **TODOS** os arquivos e pastas:
  - `.htaccess` (raiz)
  - `composer.json` e `composer.lock`
  - `config.php`
  - Pasta `public/` completa
  - Pasta `templates/` completa
  - Pasta `vendor/` completa (ou instale via SSH)
  - Pasta `src/` (se houver arquivos)

### 3. Configuração no Servidor

**Não é necessário configurar nada!** 

O `index.php` está na raiz do projeto, então funciona diretamente no `public_html/` (document root padrão).

### 4. Permissões
Configure as permissões corretas:
- Pastas: **755**
- Arquivos: **644**
- Se usar cache do Twig: pasta `cache/` com **755** ou **777**

### 5. Instalação de Dependências (se necessário)

Se você não fez upload da pasta `vendor/`, conecte via SSH e execute:

```bash
cd public_html  # ou seu diretório
composer install --no-dev --optimize-autoloader
```

### 6. Teste
- [ ] Acesse seu domínio no navegador
- [ ] Verifique se a página carrega corretamente
- [ ] Teste o formulário de contato
- [ ] Verifique se as imagens carregam

## ⚠️ Problemas Comuns

### Erro 500
- Verifique se PHP 8.0+ está ativo
- Verifique os logs de erro no cPanel
- Certifique-se de que `mod_rewrite` está habilitado

### Página em branco
- Verifique se a pasta `vendor/` existe e está completa
- Verifique os logs de erro do PHP
- Teste com `error_reporting(E_ALL)` temporariamente

### CSS/Imagens não aparecem
- Verifique se os caminhos estão corretos
- Limpe o cache do navegador (Ctrl+F5)
- Verifique as permissões da pasta `public/img/`

## 📧 Próximos Passos

1. **Configure o envio de email** do formulário de contato
2. **Habilite o cache do Twig** em produção (melhor performance)
3. **Configure SSL/HTTPS** e descomente as regras no `.htaccess`
4. **Configure backups** regulares

## 📞 Suporte

Em caso de problemas, verifique:
- Logs de erro do Apache no cPanel
- Logs de erro do PHP
- Versão do PHP (deve ser 8.0+)
- Permissões de arquivos e pastas
