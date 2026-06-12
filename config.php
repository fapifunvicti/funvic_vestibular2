<?php

if(isset($config)) unset($config);


$config = new App\Core\Config();
$config->url = "http://10.0.3.65:8000";
$config->root_path = __DIR__;
$config->template_dir = "default";
$config->template_path = $config->root_path . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $config->template_dir;

$config->db_driver = "mysql";
$config->db_host =  "mariadb";
$config->db_name = "vestibular2"; //__DIR__ . DIRECTORY_SEPARATOR . "db" . DIRECTORY_SEPARATOR . 'vestibular.db';
$config->db_user = "root";
$config->db_passwd = "root";
$config->db_charset = "utf-8";
$config->db_collation = "utf8mb4_unicode_ci";
$config->db_prefix = "";

