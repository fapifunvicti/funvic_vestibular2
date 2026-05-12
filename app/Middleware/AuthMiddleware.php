<?php
namespace App\Middleware;

use App\Interfaces\MiddlewareInterface;
use App\Core\Request;

class AuthMiddleware implements MiddlewareInterface {
    public function handle(Request $request, callable $next): mixed{
        

        $req = $request;
    
        return $next($request);
    }
}