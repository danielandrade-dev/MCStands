# M Coelho Stands - Site Institucional

Site institucional desenvolvido com Slim Framework 4 e Twig para a empresa M Coelho Stands.

## 📋 Requisitos

- PHP 8.0 ou superior
- Composer
- Apache com mod_rewrite habilitado (ou Nginx com configuração adequada)

## 🚀 Instalação Local

1. Clone o repositório ou baixe os arquivos
2. Instale as dependências:
```bash
composer install
```

3. Inicie o servidor de desenvolvimento:
```bash
composer start
```

4. Acesse `http://localhost:8000` no navegador

## 📤 Deploy em Hospedagem Compartilhada (Hostgator, etc.)

### Opção 1: Document Root é o diretório `public/` (Recomendado)

1. **Faça upload de todos os arquivos** para o servidor via FTP/SFTP
2. **Configure o document root** no painel da hospedagem para apontar para o diretório `public/`
3. **Acesse seu site** - deve funcionar imediatamente

### Opção 2: Document Root é a raiz do projeto

Se você não puder alterar o document root:

1. **Faça upload de todos os arquivos** para o servidor
2. O arquivo `.htaccess` na raiz já está configurado para redirecionar para `public/`
3. **Acesse seu site** - deve funcionar automaticamente

### Passos Detalhados para Hostgator:

1. **Acesse o File Manager** no cPanel da Hostgator
2. **Navegue até a pasta public_html** (ou o diretório do seu domínio)
3. **Faça upload de todos os arquivos** do projeto
4. **Configure o document root** (se possível):
   - No cPanel, vá em "Subdomínios" ou "Domínios"
   - Altere o document root para apontar para `public_html/public`
5. **Verifique as permissões**:
   - Pastas: 755
   - Arquivos: 644
6. **Instale as dependências** via SSH (se disponível):
```bash
cd public_html
composer install --no-dev --optimize-autoloader
```

Ou faça upload da pasta `vendor/` completa do seu ambiente local.

### Estrutura de Diretórios no Servidor

```
public_html/ (ou seu diretório)
├── .htaccess
├── composer.json
├── composer.lock
├── config.php
├── public/
│   ├── .htaccess
│   ├── index.php
│   └── img/
│       └── logo.jpeg
├── src/
├── templates/
│   ├── base.twig
│   └── home.twig
└── vendor/
    └── (dependências do Composer)
```

## ⚙️ Configurações

### Arquivo `config.php`

Edite o arquivo `config.php` na raiz do projeto para ajustar:
- Ambiente (development/production)
- Cache do Twig
- Configurações de email
- Timezone

### Cache do Twig (Produção)

Para melhor performance em produção, habilite o cache do Twig:

1. Crie a pasta `cache/twig` na raiz do projeto
2. Edite `public/index.php` e altere:
```php
$twig = Twig::create(__DIR__ . '/../templates', ['cache' => __DIR__ . '/../cache/twig']);
```

3. Certifique-se de que a pasta `cache` tenha permissão de escrita (755 ou 777)

## 🔒 Segurança

- O arquivo `.htaccess` na raiz protege arquivos sensíveis como `composer.json` e `.env`
- Headers de segurança estão configurados no `.htaccess` do `public/`
- Sempre use HTTPS em produção (descomente as regras no `.htaccess`)

## 📝 Formulário de Contato

O formulário de contato está configurado mas precisa de implementação para envio de email. Você pode:

1. **Usar a função `mail()` do PHP** (não recomendado em produção)
2. **Integrar com PHPMailer** ou similar
3. **Usar um serviço de terceiros** (SendGrid, Mailgun, etc.)
4. **Integrar com um CRM** ou ferramenta de formulários

## 🐛 Solução de Problemas

### Erro 500 (Internal Server Error)
- Verifique se o PHP 8.0+ está instalado
- Verifique as permissões dos arquivos e pastas
- Verifique os logs de erro do Apache no cPanel

### Página em branco
- Verifique se todas as dependências estão instaladas (`vendor/` existe)
- Verifique os logs de erro do PHP
- Certifique-se de que o `mod_rewrite` está habilitado

### CSS/Imagens não carregam
- Verifique se os caminhos estão corretos
- Verifique as permissões da pasta `public/img/`
- Limpe o cache do navegador

### Erro de autoload
- Certifique-se de que a pasta `vendor/` foi enviada completamente
- Execute `composer install` novamente no servidor (se SSH estiver disponível)

## 📞 Suporte

Para dúvidas sobre o projeto, consulte a documentação do Slim Framework: https://www.slimframework.com/docs/

