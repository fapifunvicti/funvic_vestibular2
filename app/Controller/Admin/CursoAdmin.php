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
        \App\Core\DB::get();

        $cursos = \App\Model\Curso::get()->all();

        $tpl->addTemplate("admin/tpl/header.php")
            ->addTemplate("admin/partes/topo.php")
            ->addTemplate("admin/partes/menu.php")
            ->addTemplate("admin/cursos/index.php", ['cursos' => $cursos])
            ->addTemplate("admin/tpl/footer.php");

        return $response->html($tpl->renderTemplate());
    }
}