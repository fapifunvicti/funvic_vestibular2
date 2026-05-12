<?php

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Se o arquivo existe em public/ serve direto (assets, css, js, imagens)
if ($uri !== '/' && file_exists(__DIR__ . '/public' . $uri)) {
    return false;  // serve o arquivo estático normalmente
}

// Caso contrário redireciona para o index.php
require_once __DIR__ . '/public/index.php';