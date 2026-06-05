<?php
namespace App\Core;


class Pipeline {
    private array $middlewares;
    private \App\Core\Controller $controller;
    private string $method;
    private array $params;

    public function __construct(array $middlewares, Controller $controller, string $method, array $params)
    {   
        $this->middlewares = $middlewares;
        $this->controller = $controller;
        $this->method = $method;
        $this->params = $params;
       
    }

    public function Run(Request $request): mixed {
        return $this->runMiddleware($request,0);
    } 

    private function runMiddleware(Request $request, int $index): mixed {
        if($index >= count($this->middlewares)){
            return \call_user_func_array([$this->controller, $this->method], $this->params);
        }

        $middlewareClass = $this->middlewares[$index];
        $middlewareInstance = new $middlewareClass();

        return $middlewareInstance->handle($request, function(Request $request) use ($index){
            return $this->runMiddleware($request, $index+1);
        });

    }

}