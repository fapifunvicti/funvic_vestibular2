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


#[MiddlewareAttribute(\App\Middleware\AuthMiddleware::class)]
class ProcessoAdmin extends Controller {

     #[RouteAttribute("/admin/processo", method: "GET")]
     public function index(Request $request, Response $response): Response {
        global $config;
        $tpl = new \App\Core\Template($request, $config);
        \App\Core\DB::get();

        //$alert = new \App\Libs\Alert($config, $tpl, "admin/partes/alert_model.php");


        $curso    = \App\Model\Curso::all();
        $coligada = \App\Model\Coligada::all();
        $ensino   = \App\Model\Ensino::all(); 

        $tpl->addTemplate("admin/tpl/header.php", ['titulo' => "PROCESSOS SELETIVOS"])
            ->addTemplate("admin/partes/topo.php", ['titulo' => "PROCESSOS SELETIVOS"])
            ->addTemplate("admin/partes/menu.php")
            //->addTemplate("admin/processo/form_editar.php", ['editar' => false,
            //                                                 'ensino' => $ensino,
            //                                                 'curso' => $curso,
            //                                                 'coligada' => $coligada,])

           // ->addTemplate(\App\Libs\Alert::Success($alert, "danger", "Houve um Erro!", "AAAA"))
            ->addTemplate("admin/processo/index.php", ['ensino' => $ensino,
                                                        'alerta' => ''])

            ->addTemplate("admin/tpl/footer.php");

        return $response->html($tpl->renderTemplate());
     }


        #[RouteAttribute("/admin/processo/cadastrar", method: "GET|POST")]
        public function cadastrar(Request $request, Response $response): Response {
            global $config;
            $tpl = new \App\Core\Template($request, $config);
            \App\Core\DB::get();


            if($request->isPost()){

                $post = $request->getParsedBody();

                switch($post['form']){
                    case 'cadastrar':
                        {
                            $now = new DateTime('now', new DateTimeZone($config->timezone));
                            $processo = new \App\Model\ProcessoSeletivo();

                            $processo->nome = $post['nome'];
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
                            $processo->ordem = (int)$post['ordem'] > 0 ? 1 : 0;

                            if(!$processo->save()){
                                $response->redirect("/admin/processo", 302)->send();
                                return  $response->html("");
                            }


                            $response->redirect("/admin/processo", 302)->send();
                            return  $response->html("");
                        }
                    break;
                }

            }



            $curso    = \App\Model\Curso::all();
            $coligada = \App\Model\Coligada::all();
            $ensino   = \App\Model\Ensino::all(); 


        $tpl->addTemplate("admin/tpl/header.php", ['titulo' => "PROCESSOS SELETIVOS"])
            ->addTemplate("admin/partes/topo.php", ['titulo' => "PROCESSOS SELETIVOS"])
            ->addTemplate("admin/partes/menu.php")
            ->addTemplate("admin/processo/form_editar.php", ['editar' => false,
                                                             'ensino' => $ensino,
                                                             'curso' => $curso,
                                                             'coligada' => $coligada,])

           // ->addTemplate(\App\Libs\Alert::Success($alert, "danger", "Houve um Erro!", "AAAA"))
           // ->addTemplate("admin/processo/index.php", ['ensino' => $ensino,
           //                                             'alerta' => ''])

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
                        $processo->ordem = (int)$post['ordem'];
                        
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