<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Container\Container;


if(!is_dir(__DIR__ . DIRECTORY_SEPARATOR . "vendor")){
    exit("por favor rode composer install para instalar as dependencias");
}

if(!is_file(__DIR__ . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . 'autoload.php')){
    exit("vendor/autoload.php nao encontrado!");
}
require_once "vendor/autoload.php";
require_once "routes.php";

if(!is_file(__DIR__ . DIRECTORY_SEPARATOR . "config.php")){
    exit("config.php faltando. por favor crie o arquivo para continuar");
}


require_once __DIR__ .  DIRECTORY_SEPARATOR .  "config.php";
require_once __DIR__ .  DIRECTORY_SEPARATOR .  "funcoes.inc.php";

date_default_timezone_set($config->timezone);

if (session_status() !== PHP_SESSION_ACTIVE || session_status() === PHP_SESSION_NONE) {
   
    session_name($config->session_name);
    session_start();
}


switch($config->modo){
    case 'debug':
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        break;

    default:
        ini_set('display_errors', 0);
        ini_set('display_startup_errors', 0);
        error_reporting(0);
        break;
}

$timezone = date_default_timezone_get();

if(strcmp($timezone, ini_get("date.timezone")) !== 0){
        setlocale(LC_ALL, $config->timezone);
}
//$templates = new \App\Core\TemplateManager($config);


if(!is_dir(__DIR__ . DIRECTORY_SEPARATOR . 'templates')){
        mkdir(__DIR__ . DIRECTORY_SEPARATOR . 'templates', 0755);
}

if(!is_writable(__DIR__ . DIRECTORY_SEPARATOR . 'templates')){
    exit("templates not writable");
}

if(!is_dir(__DIR__ . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'default')){
        mkdir(__DIR__ . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'default', 0755);
}

/*
$capsule = new Capsule();

$db_driver = null;
$db_config = [];


switch($config->db_driver){
    case 'mysql':
        $db_config = [
            'driver'    => $config->db_driver,
		    'host'      =>  $config->db_host,
		    'database'  =>  $config->db_name,
		    'username'  =>  $config->db_user,
		    'password'  =>  $config->db_passwd,
		    'charset'   => 'utf8mb4',
		    'collation' => 'utf8mb4_unicode_ci',
		    'prefix'    => '',
        ];
    break;

    case 'sqlite3':
        $db_config = [
            'driver' => $config->db_driver,
            'host'   => $config->db_host,
            'charset' => $config->db_charset,
            'collation' => $config->db_collation,
            'prefix'    => $config->db_prefix
        ];
    break;
}


$capsule->addConnection($db_config);
$capsule->setAsGlobal();
$capsule->bootEloquent();
*/