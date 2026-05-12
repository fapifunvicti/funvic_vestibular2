<?php
namespace App\Controller;

use App\Attributes\RouteAttribute;
use App\Core\Request;

use App\Core\Template as Tpl;
use App\Core\Response;
use App\Core\Controller;
use App\Core\DB;

use App\Attributes\MiddlewareAttribute;

#[MiddlewareAttribute(\App\Middleware\AuthMiddleware::class)]
class Curso extends Controller {
    
    #[RouteAttribute("/curso", method:"GET")]
    public function index(Request $request, Response $response): Response {
        global $config;
        $tpl = new Tpl($request, $config);
        
        $tpl->addTemplate("header.php", ['titulo' => "TESTE TITULO"])
            ->addTemplate("partes/menu.inc.php")
            ->addTemplate("partes/banner.inc.php")
            ->addTemplate("cursos/index.php")
            ->addTemplate("footer.php");

        return $response->html($tpl->renderTemplate(), 200);

    }
}