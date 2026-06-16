<?php
namespace App\Middleware;

use App\Core\Response;
use App\Interfaces\MiddlewareInterface;
use App\Core\Request;

class AuthMiddleware implements MiddlewareInterface {
    public function handle(Request $request, callable $next): mixed{
        $response = new Response();

        $uri = $request->getUri();

        if($uri == "/admin/login"){
            if($request->getSession("admin") !== null){
                $response->redirect("/admin/processo")->send();
                return $next($request);
            }
            
            return $next($request);
        }


        if(!isset($_SESSION['admin'])){
            $_SESSION['aviso']['titulo'] = "Erro";
            $_SESSION['aviso']['mensagem'] = "Acesso Expirou por favor entre com login novamente";



            $response->redirect("/admin/login")->send();
            return $next($request);
        }


        if(isset($_SESSION['admin']['time']) &&  time() >= (int)$_SESSION['admin']['time']){
            $_SESSION['aviso']['titulo'] = "Erro";
            $_SESSION['aviso']['mensagem'] = "Tempo de Acesso Expirou por favor entre com login novamente";
            if(isset($_SESSION['admin'])) 
                unset($_SESSION['admin']);
            $response->redirect("/admin/login")->send();
            return $next($request);
        }


        

       
        return $next($request);
    }
}