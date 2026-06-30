<?php
require_once __DIR__ .  "/../bootstrap.php";

/**
 * @var string $uri
 * @var string $method
 */


$router = new \App\Router();

$router->registerController([

    \App\Controller\Home::class,
    \App\Controller\Curso::class,
    \App\Controller\Admin\CursoAdmin::class,
    \App\Controller\Admin\MenuAdmin::class,
    \App\Controller\Admin\ProcessoAdmin::class,
    \App\Controller\Admin\AdminLogin::class,
    \App\Controller\Admin\DashboardAdmin::class,
    \App\Controller\Admin\VestibularAdmin::class,
]);

$method = $_SERVER['REQUEST_METHOD'];
$uri    = $_SERVER['REQUEST_URI'] ?? "";


// executa as rotas
$router->dispatch($uri, $method);