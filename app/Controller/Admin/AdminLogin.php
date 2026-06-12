<?php 
namespace App\Controller\Admin;

use App\Attributes\MiddlewareAttribute;
use App\Attributes\RouteAttribute;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;



#[MiddlewareAttribute(\App\Middleware\AuthMiddleware::class)]
class AdminLogin extends Controller {

    #[RouteAttribute("/admin/login", method:"GET|POST")]
    public function index(Request $request, Response $response): Response {
        global $config;
        $tpl = new \App\Core\Template($request, $config);
        \App\Core\DB::get();


        if($request->isPost()){
            
            return $response->html("");
        }


        $tpl->addTemplate("admin/tpl/header.php", ['titulo' => "LOGIN"])
            ->addTemplate("login/index.php")
            ->addTemplate("admin/tpl/footer.php");

        return $response->html($tpl->renderTemplate());
    } 
}