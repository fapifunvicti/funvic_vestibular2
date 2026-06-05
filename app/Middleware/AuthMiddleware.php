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
            if($request->getSession("user") !== null){
                $response->redirect("/admin/processos")->send();
                return $next($request);
            }
            
            return $next($request);
        }
    


        $response->redirect("/admin/login")->send();
        return $next($request);
    }
}