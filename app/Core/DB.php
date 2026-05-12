<?php

namespace App\Core;

use \Illuminate\Database\Capsule\Manager as Capsule;

class DB {

    public static function get(): Capsule {
		global $config;
		$capsule = new Capsule();
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

        case 'sqlite':
            $db_config = [
                'driver' => $config->db_driver,
                'database'   => $config->db_name,
                'charset' => $config->db_charset,
                'collation' => $config->db_collation,
                'prefix'    => $config->db_prefix
            ];
        break;
}



		$capsule->addConnection($db_config);

		// Make this Capsule instance available globally via static methods
		$capsule->setAsGlobal();

		// Setup the Eloquent ORM...
		$capsule->bootEloquent();
		return $capsule;
    }

}