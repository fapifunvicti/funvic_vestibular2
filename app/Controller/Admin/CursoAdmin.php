<?php 
namespace App\Controller\Admin;

use App\Attributes\RouteAttribute;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;

use App\Attributes\MiddlewareAttribute;

#[MiddlewareAttribute(\App\Middleware\AuthMiddleware::class)]
class CursoAdmin extends Controller {


    #[RouteAttribute("/admin/curso", method: "GET|POST")]
    public function index(Request $request, Response $response) : Response {
        global $config;
        $tpl = new \App\Core\Template($request, $config);
        \App\Core\DB::get();

        $query = $request->query_string->all();

        if($request->isPost()){


            $post = $request->getParsedBody();
            $editar = $request->query_string->as_bool('editar');

            switch($post['form']){

                case 'editar':
                    if(isset($query['editar']) && !(bool)$query['editar']){
                        $html = $tpl->renderTemplateFile("admin/cursos/campo_nome_editavel.php", ['modo_editar' => false, 'curso' => 0]);
                        $response->setStatusCode(404)
                                ->header("HX-Redirect", "/admin/curso")
                                ->send();
                        return $response->html("");
                    }

                    $curso_dados  = \App\Model\Curso::where('idcurso', '=', $post['id'])->get()->first();
               
                    if(!$curso_dados){
                        return $response->header("HX-Redirect", get_url("admin/cursos"));
                    }

                    $editar = \App\Model\Curso::find($post['id']);

                    $editar->nome = $post['nome'];
                    $editar->ativo = (int)$post['ativo'];
                    $editar->save();

                    $html = $tpl->renderTemplateFile("admin/cursos/campo_nome_editavel.php", ['modo_editar' => false, 'curso' => $editar]);
                    return $response->html($html);
            }
        
        }

        


        if(isset($query['editar']) &&  $request->query_string->as_bool('editar') === true ){

            if(!$request->is_htmx()){
                $response->setStatusCode(404)->send();
                return $response->html("");
            }

            $id = $request->query_string->as_int('id');

            $curso_dados  = new \App\Model\Curso();
            $dados = $curso_dados->where('idcurso', '=', $id)->get()->first();
            if(!$curso_dados){
                return $response->header("HX-Redirect", get_url("admin/cursos"));
            }

   
            $html = $tpl->renderTemplateFile("admin/cursos/campo_nome_editavel.php", ['modo_editar' => true, 'curso' => $dados]);
            
            return $response
                ->withHeaders(['Cache-Control' => 'no-store, no-cache, must-revalidate', 
                                'Pragma' => 'no-cache'])
                ->html($html);
        }
        

        $cursos = \App\Model\Curso::cursor();

        $tpl->addTemplate("admin/tpl/header.php", ['titulo' => "CURSOS"])
            ->addTemplate("admin/partes/topo.php", ['titulo' => "CURSOS DISPONIVEIS"])
            ->addTemplate("admin/partes/menu.php")
            ->addTemplate("admin/cursos/index.php", ['cursos' => $cursos])
            ->addTemplate("admin/tpl/footer.php");

        return $response->html($tpl->renderTemplate());
    }
}