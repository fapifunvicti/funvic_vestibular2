<?php
namespace App\Controller\Admin;

use App\Attributes\RouteAttribute;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use DateTime;
use DateTimeZone;
use Illuminate\Database\QueryException;
use App\Attributes\MiddlewareAttribute;


class VestibularAdmin extends Controller {

     #[RouteAttribute("/admin/vestibular", method: "GET")]
     public function index(Request $request, Response $response) : Response {
        global $config;
        $tpl = new \App\Core\Template($request, $config);
        \App\Core\DB::get();


    

    $tpl->addTemplate("admin/tpl/header.php", ['titulo' => "VESTIBULAR"])
            ->addTemplate("admin/partes/topo.php", ['titulo' => "VESTIBULARES"])
            ->addTemplate("admin/partes/menu.php")
            ->addTemplate("admin/vestibular/index.php")
            ->addTemplate("admin/tpl/footer.php");

        return $response->html($tpl->renderTemplate());
     }
}