<?php 
namespace App\Libs;

use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTWrapper {
    const PRIVATE_KEY = "7FSXa32A865V6AUI900FF4133LJA";


    public static function encode(array $options): string {

        
        $time  = time();
 

        return JWT::encode([
            'iat' => $time,
            'iss' => $options['iss'],
            'exp' =>  $time + $options['expiration_sec'],
            'nbf' => $time - 1,
            'data' => $options['userdata']
        ], self::PRIVATE_KEY, 'HS512');
    }


    public static function decode(string $jwt){
        return JWT::decode($jwt, new Key(self::PRIVATE_KEY, 'HS512'));
    }
}