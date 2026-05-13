<?php
require_once __DIR__ .  "/../bootstrap.php";



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



$router = new \App\Router();

$router->registerController([
   \App\Controller\Home::class,
    App\Controller\Curso::class,
    \App\Controller\Admin\CursoAdmin::class,
]);

/**
 * @var string $method
 */
$method = $_SERVER['REQUEST_METHOD'];

/**
 * @var string $uri
 */
$uri    = $_SERVER['REQUEST_URI'];


//$templates->addTemplate("header", App\Core\Template::class, "tpl/header.php");



$router->dispatch($uri, $method);