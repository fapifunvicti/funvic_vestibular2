<?php
namespace App\Controller\Admin;

use App\Attributes\RouteAttribute;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;


class ProcessoAdmin extends Controller {

     #[RouteAttribute("/admin/processo", method: "GET|POST")]
     public function index(Request $request, Response $response): Response {
        global $config;
        $tpl = new \App\Core\Template($request, $config);
        \App\Core\DB::get();


        $ensino = \App\Model\Ensino::all();

        $tpl->addTemplate("admin/tpl/header.php", ['titulo' => "PROCESSOS SELETIVOS"])
            ->addTemplate("admin/partes/topo.php", ['titulo' => "PROCESSOS SELETIVOS"])
            ->addTemplate("admin/partes/menu.php")
            ->addTemplate("admin/processo/index.php", ['ensino' => $ensino])
            ->addTemplate("admin/tpl/footer.php");

        return $response->html($tpl->renderTemplate());
     }

}