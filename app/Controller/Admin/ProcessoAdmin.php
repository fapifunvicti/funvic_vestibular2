<?php
namespace App\Controller\Admin;

use App\Attributes\RouteAttribute;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use DateTime;
use DateTimeZone;
use Exception;
use Illuminate\Database\QueryException;

class ProcessoAdmin extends Controller {

     #[RouteAttribute("/admin/processo", method: "GET")]
     public function index(Request $request, Response $response): Response {
        global $config;
        $tpl = new \App\Core\Template($request, $config);
        \App\Core\DB::get();


        $ensino = \App\Model\Ensino::all();

        $tpl->addTemplate("admin/tpl/header.php", ['titulo' => "PROCESSOS SELETIVOS"])
            ->addTemplate("admin/partes/topo.php", ['titulo' => "PROCESSOS SELETIVOS"])
            ->addTemplate("admin/partes/menu.php")
            ->addTemplate("admin/processo/form_editar.php", ['editar' => false])
            ->addTemplate("admin/processo/index.php", ['ensino' => $ensino])
            ->addTemplate("admin/tpl/footer.php");

        return $response->html($tpl->renderTemplate());
     }


     #[RouteAttribute("/admin/processo/editar/{id:int}", method: "GET|POST")]
     public function editar(Request $request, Response $response): Response {
        global $config;
        $tpl = new \App\Core\Template($request, $config);
        \App\Core\DB::get();


        if($request->isPost()){
            $id = $request->get_uri_args()[0] ?? null;
            $post = $request->getParsedBody();

            $processo = \App\Model\ProcessoSeletivo::find($id);

            if(!$processo){
                $response->redirect("/admin/processo", 302)->send();
                return  $response->html("");
            }


            switch($post['form']){
                case 'editar':
                    {

                        $now = new DateTime('now', new DateTimeZone($config->timezone));

                        $processo = \app\Model\ProcessoSeletivo::find($id);
                        $processo->nome = $post['nome'];
                        $processo->fk_curso = (int)$post['curso'];
                        $processo->fk_coligada = (int)$post['coligada'];
                        $processo->fk_ensino = (int)$post['ensino'];
                        $processo->data_prova = $post['dataprova'];
                        $processo->id_totvs = (int)$post['idtotvs'] ?? 0;
                        $processo->habilitar_resultado = (int)$post['resultado'] > 0 ? 1 : 0;
                        $processo->data_resultado_inicio = $post['datainicio'];
                        $processo->data_resultado_fim = $post['datafim'];
                        $processo->categoria = $post['categoriaid'];
                        $processo->habilitar_resultado = (int)$post['resultado'] > 0 ? 1 : 0;
                        
                        if(isset($post['ativo']) && (int)$post['ativo'] === 0){
                            $processo->deletado_em = $now->format("Y-m-d H:i:s");
                        }else {
                            $processo->deletado_em = null;
                        }

                        

                        if(!$processo->save()){
                            $response->redirect("/admin/processo", 302)->send();
                            return  $response->html("");
                        }


                        $response->redirect("/admin/processo", 302)->send();
                        return  $response->html("");

                    }
                break;
            }

            return $response->html("");
        }

        $ensino = \App\Model\Ensino::all();
        $id = (int)$request->get_uri_args()[0] ?? null;
        $processo = \App\Model\ProcessoView::find($id);


        $curso    = \App\Model\Curso::all();
        $coligada = \App\Model\Coligada::all();
        $ensino   = \App\Model\Ensino::all(); 

        if(!$processo){
                $response->redirect("/admin/processo", 302)->send();
                return $response->getContent();
        }

        //$processo = $processo->first();

        $titulo = $processo->nome ?? "Sem Nome";

        $tpl->addTemplate("admin/tpl/header.php", ['titulo' => "Editar {$titulo}"])
            ->addTemplate("admin/partes/topo.php", ['titulo' => " EDITAR - {$titulo}"])
            ->addTemplate("admin/partes/menu.php")
            ->addTemplate("admin/processo/form_editar.php", ['editar' => true, 
                                                                        'processo'=> $processo,
                                                                        'curso' => $curso,
                                                                        'coligada' => $coligada,
                                                                        'ensino' => $ensino
                                                                    ])
            //->addTemplate("admin/processo/index.php", ['ensino' => $ensino])
            ->addTemplate("admin/tpl/footer.php");

            return $response->html($tpl->renderTemplate());
        
      
     }


}