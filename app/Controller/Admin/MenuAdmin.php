<?php 
namespace App\Controller\Admin;

use App\Attributes\RouteAttribute;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Attributes\MiddlewareAttribute;

//#[MiddlewareAttribute(\App\Middleware\AuthMiddleware::class)]
class MenuAdmin extends Controller {


    #[RouteAttribute("/admin/menu", method:"GET|POST")]
    public function index(Request $request, Response $response): Response {
        global $config;
        $tpl = new \App\Core\Template($request, $config);
        \App\Core\DB::get();

        $query = $request->query_string;

        if($query->has('editar') && $query->is_int('id') && $request->is_htmx()){
            $id =    $query->as_int('id');
            $menuModel = new \App\Model\MenuItem();
            $menu = $menuModel->where('idmenu','=', $id)->first();


            $menuList = new \App\Model\ArvoreMenuView();
            $menuList = $menuList->cursor();
            $html = $tpl->renderTemplateFile("admin/menu/form_editar.php", ['editar' => true, 'menu' => $menu, 'lista_menu' => $menuList ]);
            return $response->html($html);
        }

        
        if($request->isPost()){
            $post = $request->getParsedBody();

            switch($post['form']){
                case 'editar':
                {
                    $menuModel = \App\Model\MenuItem::find((int)$post['id']); 

                    if(!$menuModel){
                        $response->redirect("/admin/menu")->send();
                        return $response->html("");
                    }

                    $menuModel->nome = $post['nome'];
                    $pai_id = (int)$post['pai'] === 0 ? NULL :  (int)$post['pai'];
                    $menuModel->pai_id =  $pai_id;
                    $menuModel->dropdown = (int)$post['dropdown'];
                    $menuModel->ativo = (int)$post['ativo'];
                    $menuModel->ordem = (int)$post['ordem'];
                    $menuModel->url = $post['url'];

                    if(!$menuModel->save()){
                        $response->redirect("/admin/menu")->send();
                        return  $response->html("");
                    }
                }
                break;

                case 'cadastrar':
                {
                    $menuModel = new \App\Model\MenuItem();
                    $menuModel->nome = $post['nome'];
                    $menuModel->pai_id = (int)$post['pai'] === 0 ? NULL :  (int)$post['pai'];
                    $menuModel->dropdown = (int)$post['dropdown'];
                    $menuModel->ativo = (int)$post['ativo'];
                    $menuModel->ordem = (int)$post['ordem'];
                    $menuModel->url = $post['url'];

                    if(!$menuModel->save()){
                        $response->redirect("/admin/menu")->send();
                        return  $response->html("");
                    }


                }
                break;

            }



             $response->redirect("/admin/menu")->send();
             return  $response->html("");;
        }


        $menu = new \App\Model\ArvoreMenuView();

        $menuList = new \App\Model\ArvoreMenuView();
        $menuList = $menuList->cursor();    

        $tpl->addTemplate("admin/tpl/header.php", ['titulo' => "MENU"])
            ->addTemplate("admin/partes/topo.php", ['titulo' => "MENU DO SITE"])
            ->addTemplate("admin/partes/menu.php")
            ->addTemplate("admin/menu/form_editar.php", ['editar' => false, 'menu' => $menu, 'lista_menu' => $menuList])
            ->addTemplate("admin/menu/index.php", ['menu' => $menu])
            ->addTemplate("admin/tpl/footer.php");
        return $response->html($tpl->renderTemplate());
    }


}


