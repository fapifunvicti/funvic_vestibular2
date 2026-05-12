<?php

namespace App\Core;

final class Config {
    public string $url = "http://localhost:8000";
    public string $root_path = __DIR__;

    public string $db_host = "localhost";
    public string $db_user = "";
    public string $db_passwd = "";

    public string $db_name  = "";

    public int $db_port = 3306;

    public string $db_charset = "utf-8";

    public string $db_collation = "utf8mb4_unicode_ci";

    public string $db_prefix = ""; 

    public string $db_driver = "mysql";

    public string $timezone = "America/Sao_Paulo";
    public string $lang     = "pt-br";

    public string $template_dir = "default";
    public string $template_path = __DIR__ . \DIRECTORY_SEPARATOR . 'templates';

    public string $session_name  = "projetotest2";

    public string $modo  = "production";
}