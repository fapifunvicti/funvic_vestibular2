<?php
namespace App\Controller\Admin;

use App\Attributes\MiddlewareAttribute;
use App\Attributes\RouteAttribute;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;

class ColigadaAdmin extends Controller {
        
    #[RouteAttribute("/admin/coligada", method:"GET|POST")]
    public function index(Request $request, Response $response) : Response {
        global $config;
        $tpl = new \App\Core\Template($request, $config);


        if($request->isPost()){
            $post = $request->getParsedBody();
            $id = \filter_var((int)$post['id'], \FILTER_VALIDATE_INT, [\FILTER_REQUIRE_SCALAR]);

            $coligadaModel =\App\Model\Coligada::find($id);

            $coligadaModel->nome = $post['nome'];
            if(!$coligadaModel->save()){
                    $response->redirect("/admin/coligada",302)->send();
                    return $response->html("");
            }

            $response->redirect("/admin/coligada",302)->send();
            return $response->html("");

        }

        $query = $request->query_string->all();



        if(isset($query['status']) && $query['status']){

            $ativo = \filter_var((int)$query['ativo'], \FILTER_VALIDATE_INT, [\FILTER_REQUIRE_SCALAR]) ?? 0; 
            $id =   \filter_var($query['id'], \FILTER_VALIDATE_INT, [\FILTER_REQUIRE_SCALAR]); 

            if(!$id){
                    $response->header('HX-Redirect', "/admin/coligada")->send();
                    return $response->html("");
            }

            $coligadaModel =\App\Model\Coligada::find($id);


            $coligadaModel->ativo = !$ativo;
            
            if(!$coligadaModel->save()){
                    $response->header('HX-Redirect', "/admin/coligada")->send();
                    return $response->html("");
            }

              $response->header('HX-Redirect', "/admin/coligada")->send();
              return $response->html("");

        }
        /*
        else if(isset($query['editar']) && $query['editar']){
            $id =   \filter_var((int)$query['id'], \FILTER_VALIDATE_INT, [\FILTER_REQUIRE_SCALAR]); 

            $coligada = \App\Model\Coligada::find($id);
            $form_tpl = $tpl->renderTemplateFile("admin/coligada/form_editar.php", ['coligada' => $coligada]);
            return $response->html($form_tpl);

        }*/


        $coligadas = \App\Model\Coligada::all();

        $tpl->addTemplate("admin/tpl/header.php", ['titulo' => "CURSOS"])
            ->addTemplate("admin/partes/topo.php", ['titulo' => "CURSOS DISPONIVEIS"])
            ->addTemplate("admin/partes/menu.php")
            ->addTemplate("admin/coligada/index.php", ['coligadas' => $coligadas])
            ->addTemplate("admin/tpl/footer.php");

        return $response->html($tpl->renderTemplate());
    }
    #[RouteAttribute("/admin/coligada/{id:int}", method:"GET|POST", is_regex: true)]
    public function editar(Request $request, Response $response) : Response {
        global $config;
        $tpl = new \App\Core\Template($request, $config);

        $id = (int)$request->get_uri_args()[0] ?? null;

        $coligada = \App\Model\Coligada::where('idcoligada','=', $id)->first();
        $coligadas = \App\Model\Coligada::all();

        $tpl->addTemplate("admin/tpl/header.php", ['titulo' => "CURSOS"])
            ->addTemplate("admin/partes/topo.php", ['titulo' => "CURSOS DISPONIVEIS"])
            ->addTemplate("admin/partes/menu.php")
            ->addTemplate("admin/coligada/form_editar.php", ['editar' => true, 'coligada' => $coligada])
            ->addTemplate("admin/coligada/index.php", ['coligadas' => $coligadas])
            ->addTemplate("admin/tpl/footer.php");

        return $response->html($tpl->renderTemplate(), 200);
    }

}