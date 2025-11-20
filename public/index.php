<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

// Detectar automaticamente o caminho do autoload
// Funciona tanto localmente quanto em hospedagem compartilhada
$autoloadPath = __DIR__ . '/../vendor/autoload.php';
if (!file_exists($autoloadPath)) {
    // Tentar caminho alternativo para hospedagens compartilhadas
    $autoloadPath = dirname(__DIR__) . '/vendor/autoload.php';
}
require $autoloadPath;

// Definir base path para URLs (útil em subdiretórios)
$basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');

// Criar aplicação Slim
$app = AppFactory::create();

// Configurar base path se necessário
if ($basePath !== '') {
    $app->setBasePath($basePath);
}

// Configurar Twig com cache desabilitado para desenvolvimento
// Em produção, você pode habilitar o cache alterando para: ['cache' => __DIR__ . '/../cache/twig']
$twig = Twig::create(__DIR__ . '/../templates', ['cache' => false]);
$app->add(TwigMiddleware::create($app, $twig));

// Variável global para base_path nos templates
$basePath = $app->getBasePath();

// Rota principal
$app->get('/', function (Request $request, Response $response) use ($basePath) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'home.twig', [
        'pageTitle' => 'M Coelho Stands | Estandes para Feiras e Eventos',
        'pageDescription' => 'M Coelho Stands - criação e montagem de estandes para feiras, congressos e eventos corporativos.',
        'base_path' => $basePath
    ]);
});

// Rota para processar formulário de contato
$app->post('/contato', function (Request $request, Response $response) use ($basePath) {
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
        'formMessage' => 'Obrigado! Seus dados foram recebidos. Em breve entraremos em contato.',
        'base_path' => $basePath
    ]);
});

// Executar aplicação
$app->run();

