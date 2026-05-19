<?php 
namespace App\Controller\Admin;

use App\Attributes\RouteAttribute;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;


class MenuAdmin extends Controller {


    #[RouteAttribute("/admin/menu", method:"GET")]
    public function index(Request $request, Response $response): Response {
        global $config;
        $tpl = new \App\Core\Template($request, $config);
        \App\Core\DB::get();

        $query = $request->query_string;

        if($query->has('editar') && $query->is_int('id') && $request->is_htmx()){
            $id =    $query->as_int('id');
            $menu = new \App\Model\MenuItem()->where('idmenu','=', $id)->first();
            $menuList = new \App\Model\ArvoreMenuView()->cursor();
            $html = $tpl->renderTemplateFile("admin/menu/form_editar.php", ['menu' => $menu, 'lista_menu' => $menuList ]);
            return $response->html($html);
        }

        


        $menu = new \App\Model\ArvoreMenuView();

    

        $tpl->addTemplate("admin/tpl/header.php", ['titulo' => "MENU"])
            ->addTemplate("admin/partes/topo.php", ['titulo' => "MENU DO SITE"])
            ->addTemplate("admin/partes/menu.php")
            ->addTemplate("admin/menu/index.php", ['menu' => $menu])
            ->addTemplate("admin/tpl/footer.php");
        return $response->html($tpl->renderTemplate());
    }


}


