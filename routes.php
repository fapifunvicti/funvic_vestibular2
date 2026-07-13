<?php
namespace App;

use App\Attributes\MiddlewareAttribute;
use App\Attributes\RouteAttribute;
use App\Core\Request;
use App\Core\Response;
use App\Core\RouteBuilder;
use ReflectionClass;

class Router {
    private array $routes = [];

    public function registerController(array $controllers): void {
        foreach($controllers as $controllerClass){
            $this->registerContollerRoute($controllerClass);
        }
    }

    public function registerMiddleware(array $middlewares): void {
        foreach($middlewares as $middlewareClass){
            $this->registerMiddleware($middlewareClass);
        }
    }

    private function registerMiddlewareClass(string $middleware){
        $reflectionClass = new ReflectionClass($middleware);

        

    }

    private function registerContollerRoute(string $controllerClass) : void {
        $reflectionClass = new ReflectionClass($controllerClass);


        $middlewareClass = \array_map(
            fn($attr) => $attr->newInstance()->handler,
            $reflectionClass->getAttributes(MiddlewareAttribute::class)
        );
        
        foreach($reflectionClass->getMethods() as $method){
            $attributes = $method->getAttributes(RouteAttribute::class);

            foreach($attributes as $attr){
                    $route = $attr->newInstance();


                    $methodMiddlewares = array_map(fn($attr) => $attr->newInstance()->handler,
                        $method->getAttributes(MiddlewareAttribute::class)
                    );

                    $this->routes[] = [
                        'path' => $route->path,
                        'method' => $route->method,
                        'is_regex' => $route->is_regex,
                        'handler' => [$controllerClass, $method->getName()],
                        'group'   => $reflectionClass->getShortName(),
                        'middlewares' => array_merge($middlewareClass, $methodMiddlewares)
                    ];

            }

        }
    } 


    public function dispatch(string $uri, string $method) : void {
        $uri = parse_url($uri, PHP_URL_PATH);

        foreach($this->routes as $route){
            /*
                checa se $route['method'] é GET ou POST, PATCH, DELETE
                se for GET|POST significa que aceita os dois ao mesmo tempo
            */
            $routes_sep = $route['method'];

            /* chega se existe o caracter | na string (str_contains so existe no PHP 8+) */
            if(\str_contains($route['method'], "|")){
                //quebra a string em array a partir do caracter '|'
                $routes_sep = \explode("|", $route['method']);
            }
            
            /* se nao contem | trata como string
                caso contrario e um array 
            */
            if(is_array($routes_sep)){

                //checa rotas que foram configuradas estao corretas
                foreach($routes_sep as $route_request){
                    if(!str_contains($route_request, $method)){
                       break;
                    }
                }
            
            //se nao existe nenhum desse quebrta loop pula direto pro erro 404
            }else if(!str_contains($route['method'], $method)){
                    continue;
            }

            //todo codigo antigo agora é feito na classe RouteBuilder
            $routeBuilder = new RouteBuilder();


            /*
             todos parametros de path é passado para o metodo build
             gera o regex a partir do input para checagem posteriores
             */
            $pattern = $routeBuilder->build($route['path']);
            
            if(preg_match($pattern, $uri, $matches)){
                //remove o primeiro registro nao tem utilidade no momento
                array_shift($matches);

                $requestHandler = new Request();
                $responseHandler = new Response();

                $controller =  new $route['handler'][0]();
                $controller = new $controller();
                $method_caller = $route['handler'][1];

                $requestHandler->set_uri_args($matches);


                $route_params = [
                   $requestHandler,
                   $responseHandler,
                   $matches ?? null
                ];

                $pipeline = new \App\Core\Pipeline(
                    $route['middlewares'],
                    $controller,
                    $method_caller,
                    $route_params
                );

                echo $pipeline->Run($requestHandler);
                return;
            }            
        }


        global $config;
        //erro 404 de rota nao econtrada
        http_response_code(404);
        
        switch($config->modo){
            default: break;
            case 'debug':
                 echo 'Rota Nao Encontrada!';
            break;
        }
       
        return;
    }
}
