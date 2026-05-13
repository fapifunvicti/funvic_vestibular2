<?php 
namespace App\Controller\Admin;

use App\Attributes\RouteAttribute;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;

class CursoAdmin extends Controller {


    #[RouteAttribute("/admin/curso")]
    public function index(Request $request, Response $response) : Response {
        global $config;
        $tpl = new \App\Core\Template($request, $config);

        $tpl->addTemplate("admin/tpl/header.php")
            ->addTemplate("admin/partes/topo.php")
            ->addTemplate("admin/partes/menu.php")
            ->addTemplate("admin/tpl/footer.php");

        return $response->html($tpl->renderTemplate());
    }
}