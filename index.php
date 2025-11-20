<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

// Detectar automaticamente o caminho do autoload
// Funciona tanto localmente quanto em hospedagem compartilhada
$autoloadPath = __DIR__ . '/vendor/autoload.php';
if (!file_exists($autoloadPath)) {
    // Tentar caminho alternativo
    $autoloadPath = dirname(__FILE__) . '/vendor/autoload.php';
}
require $autoloadPath;

// Criar aplicação Slim
$app = AppFactory::create();

// Configurar Twig com cache desabilitado para desenvolvimento
// Em produção, você pode habilitar o cache alterando para: ['cache' => __DIR__ . '/cache/twig']
$twig = Twig::create(__DIR__ . '/templates', ['cache' => false]);
$app->add(TwigMiddleware::create($app, $twig));

// Rota principal
$app->get('/', function (Request $request, Response $response) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'home.twig', [
        'pageTitle' => 'M Coelho Stands | Empresa de Montagem de Estandes SP | Estandes para Feiras',
        'pageDescription' => 'Empresa de montagem de estandes em SP. Especializada em construção e montagem de estandes para feiras, estandes corporativos, estandes promocionais e estandes para eventos. Montadora de estandes com mais de 10 anos de experiência.',
        'canonicalUrl' => 'https://www.mcoelhostands.com.br',
        'ogUrl' => 'https://www.mcoelhostands.com.br',
        'ogTitle' => 'M Coelho Stands - Empresa de Montagem de Estandes SP',
        'ogDescription' => 'Empresa de montagem de estandes em SP. Especializada em construção e montagem de estandes para feiras e eventos corporativos.',
        'ogImage' => 'https://www.mcoelhostands.com.br/public/img/logo.jpeg'
    ]);
});

// Rota para processar formulário de contato
$app->post('/contato', function (Request $request, Response $response) {
    $data = $request->getParsedBody();
    
    // Aqui você pode processar os dados do formulário
    // Por exemplo: enviar email, salvar no banco de dados, etc.
    
    // Exemplo de validação básica
    $nome = $data['nome'] ?? '';
    $email = $data['email'] ?? '';
    
    // TODO: Implementar envio de email ou salvamento no banco de dados
    
    $view = Twig::fromRequest($request);
    return $view->render($response, 'home.twig', [
        'pageTitle' => 'M Coelho Stands | Empresa de Montagem de Estandes SP | Estandes para Feiras',
        'pageDescription' => 'Empresa de montagem de estandes em SP. Especializada em construção e montagem de estandes para feiras, estandes corporativos, estandes promocionais e estandes para eventos. Montadora de estandes com mais de 10 anos de experiência.',
        'canonicalUrl' => 'https://www.mcoelhostands.com.br',
        'ogUrl' => 'https://www.mcoelhostands.com.br',
        'ogTitle' => 'M Coelho Stands - Empresa de Montagem de Estandes SP',
        'ogDescription' => 'Empresa de montagem de estandes em SP. Especializada em construção e montagem de estandes para feiras e eventos corporativos.',
        'ogImage' => 'https://www.mcoelhostands.com.br/public/img/logo.jpeg',
        'formSuccess' => true,
        'formMessage' => 'Obrigado! Seus dados foram recebidos. Em breve entraremos em contato.'
    ]);
});

// Executar aplicação
$app->run();

