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
class VestibularAdmin extends Controller {

     #[RouteAttribute("/admin/vestibular", method: "GET|POST")]
     public function index(Request $request, Response $response) : Response {
        global $config;
        $tpl = new \App\Core\Template($request, $config);
        \App\Core\DB::get();

      

        if($request->isPost()){
                $post = $request->getParsedBody();

                switch($post['form']){
                    case 'adicionar':
                    {
                        $vestibularModel = new \App\Model\Vestibular();
                        $vestibularModel->nome = $post['nome'] ?? "Vestibular Sem Nome";
                        if(!$vestibularModel->save()){

                            $_SESSION['aviso']['titulo'] = "Houve um problema!";
                            $_SESSION['aviso']['mensagem'] = "Hove um problem ao Salvar";
                            $response->redirect("/admin/vestibular",302)->send();
                            return $response->text("");
                        }
                        
                        $response->redirect("/admin/vestibular",302)->send();
                        return $response->text("");

                    }
                    break;
                    case 'editar':
                        exit;
                    break;
                        
                    default:
                        $ativo = (int)$post['ativo'];
                        $id =  (int)$post['id'];

                        $now =  new DateTime('now');
                        $vestibular = \App\Model\Vestibular::where('idvestibular', '=', $id)->first();
                        $vestibular->deletado_em = (int)$ativo  ? null : $now->format("Y-m-d H:i:s");
                        $vestibular->save();
                        $response->redirect("/admin/vestibular", 302)->send();
                        return $response->html("");
                }


        }


        $vestibularModel =  \App\Model\Vestibular::all();


        //$processos = \App\Model\ProcessoView::all();
    

        $tpl->addTemplate("admin/tpl/header.php", ['titulo' => "VESTIBULAR"])
                ->addTemplate("admin/partes/topo.php", ['titulo' => "VESTIBULARES"])
                ->addTemplate("admin/partes/menu.php")
                ->addTemplate('admin/vestibular/vestibular_editar_form.php')
                ->addTemplate("admin/vestibular/index.php", ['vestibular' => $vestibularModel]);
          
        if(isset($_SESSION['aviso'])){
                $tpl->addTemplate('partes/modal_aviso.php', [
                    'titulo'   => isset($_SESSION['aviso']['titulo']) ? $_SESSION['aviso']['titulo'] : "Aviso!",
                    'mensagem' => isset($_SESSION['aviso']['mensagem']) ? $_SESSION['aviso']['mensagem'] : "ocorreu um problema!"
                ]);
                
                unset($_SESSION['aviso']);
            }

        
        $tpl->addTemplate("admin/tpl/footer.php");

        return $response->html($tpl->renderTemplate());
     }

    #[RouteAttribute("/admin/vestibular/{id:int}", method: "GET|POST", is_regex: true)]
    public function processes(Request $request, Response $response) : Response {
        global $config;
        $tpl = new \App\Core\Template($request, $config);
        \App\Core\DB::get();

        $id = $request->get_uri_args()[0] ?? null;
     

        if(!$id){
            $response->redirect("/admin/vestibular", 302)->send();
            return $response->html("");
        }


        if($request->isPost()){
            $post = $request->getParsedBody();

            switch($post['form']){
                case 'adicionar':
                {

                    $processo_id = \filter_var($post['processo'], \FILTER_VALIDATE_INT, [FILTER_REQUIRE_SCALAR]) ?? false;
                    $processoVestibular = new \App\Model\ProcessoVestibular();

                    $processoVestibular->idvestibular_fk = $id;
                    $processoVestibular->idprocesso_fk = $processo_id;

                    if(!$processoVestibular->save()){
                        $_SESSION['aviso']['titulo'] = "Houve um problema!";
                        $_SESSION['aviso']['mensagem'] = "Houve um problema ao Salvar";
                        $response->redirect("/admin/vestibular/".h($id), 302)->send();
                        return $response->html("");
                    }

                    $response->redirect("/admin/vestibular/" . h($id), 302)->send();
                    return $response->html("");

                }
                break;
            }

            return $response->html("");
        }



        $vestibularModel = \App\Model\Vestibular::where('idvestibular', '=', $id)
                                                  ->first();
        
        if(!$vestibularModel){
            $_SESSION['aviso']['titulo'] = "Houve um problema!";
            $_SESSION['aviso']['mensagem'] = "Vestibular Inexistente, por vafor tente outro ID";
            $response->redirect("/admin/vestibular", 302)->send();
            return $response->html("");
        }


        $processo = \App\Model\ProcessoView::where('vestibular_id', $id);
        $processoListagem =  new \App\Model\ProcessoView();
        $processoListagem = $processoListagem->orderBy('idprocesso', 'desc')->get();


        $tpl->addTemplate("admin/tpl/header.php", ['titulo' => "PROCESSOS " . $vestibularModel->nome ])
        ->addTemplate("admin/partes/topo.php", ['titulo' => "PROCESSO ". $vestibularModel->nome])
        ->addTemplate("admin/partes/menu.php")
        ->addTemplate("admin/vestibular/processo_editar_form.php", ['modo' => 'adicionar', 'processos' => $processoListagem, 'id' => $id])
        ->addTemplate("admin/vestibular/processos_index.php", ['processo' => $processo ]);

        if(isset($_SESSION['aviso'])){
                $tpl->addTemplate('partes/modal_aviso.php', [
                    'titulo'   => isset($_SESSION['aviso']['titulo']) ? $_SESSION['aviso']['titulo'] : "Aviso!",
                    'mensagem' => isset($_SESSION['aviso']['mensagem']) ? $_SESSION['aviso']['mensagem'] : "ocorreu um problema!"
                ]);
                
                unset($_SESSION['aviso']);
        }
        
        $tpl->addTemplate("admin/tpl/footer.php");




        return $response->html($tpl->renderTemplate());
    }

    #[RouteAttribute("/admin/vestibular/deletar/{id:int}/{vestibular:int}", method: "GET|POST", is_regex: true)]
    public function deletar_processo(Request $request, Response $response) : Response {

            if($request->isGet()){
                $id   = $request->get_uri_args()[0] ?? null;
                $vest = $request->get_uri_args()[1] ?? null;


                $id = \filter_var($id, \FILTER_VALIDATE_INT, [\FILTER_REQUIRE_SCALAR]);
                $vest = \filter_var($vest, \FILTER_VALIDATE_INT, [\FILTER_REQUIRE_SCALAR]);
                

                if(!$id){
                    $_SESSION['aviso']['titulo'] = "Houve um problema!";
                    $_SESSION['aviso']['mensagem'] = "ID Inválida";
                    $response->redirect("/admin/vestibular", 302)->send();
                    return $response->html("");
                }
                
                

                

                \App\Model\ProcessoVestibular::where('idprocesso_fk', '=', $id)
                                             ->where('idvestibular_fk', '=', $vest) 
                                             ->delete();


                              

                $response->header('HX-Redirect', "/admin/vestibular/" . $id)->send();
                //$response->redirect("/admin/vestibular", 302)->send();
                return $response->html("");
            }

            $_SESSION['aviso']['titulo'] = "Houve um problema!";
            $_SESSION['aviso']['mensagem'] = "Requisição Inválida";
            $response->header('HX-Redirect', "/admin/vestibular")->send();
            return $response->html("");

    }

}