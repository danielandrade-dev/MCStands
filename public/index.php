<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

require __DIR__ . '/../vendor/autoload.php';

// Criar aplicação Slim
$app = AppFactory::create();

// Configurar Twig
$twig = Twig::create(__DIR__ . '/../templates', ['cache' => false]);
$app->add(TwigMiddleware::create($app, $twig));

// Rota principal
$app->get('/', function (Request $request, Response $response) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'home.twig', [
        'pageTitle' => 'M Coelho Stands | Estandes para Feiras e Eventos',
        'pageDescription' => 'M Coelho Stands - criação e montagem de estandes para feiras, congressos e eventos corporativos.'
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
        'pageTitle' => 'M Coelho Stands | Estandes para Feiras e Eventos',
        'pageDescription' => 'M Coelho Stands - criação e montagem de estandes para feiras, congressos e eventos corporativos.',
        'formSuccess' => true,
        'formMessage' => 'Obrigado! Seus dados foram recebidos. Em breve entraremos em contato.'
    ]);
});

// Executar aplicação
$app->run();

