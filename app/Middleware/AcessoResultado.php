<?php

namespace App\Middleware;

use App\Core\Response;
use App\Interfaces\MiddlewareInterface;
use App\Core\Request;


class AcessoResultado implements MiddlewareInterface {
     public function handle(Request $request, callable $next): mixed{
        $response = new Response();

        if(!isset($_SESSION['resultado']) || !isset($_COOKIE['resultado'])){
            $_SESSION['aviso']['titulo'] = "Houve um problema!";
            $_SESSION['aviso']['mensagem'] = "Por favor Selecione  o Processo Seletivo  e digite seu CPF corretamente";
            $response->redirect("/resultado")->send();
            return $next($request);
        }



        return $next($request);
    }
}