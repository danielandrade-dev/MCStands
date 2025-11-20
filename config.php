<?php
/**
 * Arquivo de configuração do projeto
 * Ajuste estas configurações conforme necessário para seu ambiente
 */

return [
    // Configurações do ambiente
    'environment' => getenv('APP_ENV') ?: 'production', // 'development' ou 'production'
    
    // Configurações do Twig
    'twig' => [
        'cache' => false, // Altere para o caminho do cache em produção: __DIR__ . '/cache/twig'
        'debug' => false, // Altere para true em desenvolvimento
    ],
    
    // Configurações de email (para formulário de contato)
    'email' => [
        'from' => 'noreply@seudominio.com.br',
        'to' => 'contato@seudominio.com.br',
        'subject' => 'Novo contato do site M Coelho Stands',
    ],
    
    // Configurações de timezone
    'timezone' => 'America/Sao_Paulo',
    
    // Base URL (deixe vazio para auto-detecção)
    'base_url' => '',
];

