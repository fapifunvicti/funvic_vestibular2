<?php
namespace App\Controller;

use App\Attributes\MiddlewareAttribute;
use App\Attributes\RouteAttribute;
use App\Core\Request;

use App\Core\Template as Tpl;
use App\Core\Response;
use App\Core\Controller;
use App\Core\DB;
use App\Libs\WebHookTOTVS;
use App\Middleware\SoapWrapper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Home extends Controller {

    #[RouteAttribute("/", method:"GET|POST", is_regex: false)]
    public function index(Request $request, Response $response) : Response {
        global $config;
        $tpl = new Tpl($request, $config);
        \App\Core\DB::get();

      if($request->isPost()){
            $capsule = DB::get();
            $tabela = $capsule->table('coligada')->select()->get();

            $post = $request->getParsedBody();
            var_dump($tabela);

            return $response->html(\serialize($post), 200);

      }


      $viewProcesso = new \App\Model\ProcessoView();
      $listaColigada = new \App\Model\Coligada();


        $tpl->addTemplate("header.php", ['titulo' => "TESTE TITULO"])
            ->addTemplate("partes/menu.inc.php")
            ->addTemplate("partes/banner.inc.php")
            ->addTemplate("home/index.php", ['processos' => $viewProcesso, 'coligadas' => $listaColigada])
            ->addTemplate("footer.php");

        return $response->html($tpl->renderTemplate(), 200);
        //return $response->html($tpl->renderTemplate(), 200);
    }

    #[RouteAttribute('/informacoes/{id:int}', 'GET', is_regex: true)]
    public function informacoes(Request $request, Response $response) : Response {
        global $config;
        $tpl = new Tpl($request, $config);
        \App\Core\DB::get();
        $args = $request->get_uri_args();

        $processo = \App\Model\ProcessoView::where('idprocesso', '=', (int)$args[0])
                                             ->get()
                                             ->first();
        if(!$processo){
            $response->setStatusCode(404)->send();
            return $response->html("");
        }
        

        $tpl->addTemplate("header.php", ['titulo' => "TESTE TITULO"])
            ->addTemplate("partes/menu.inc.php")
            ->addTemplate("partes/banner.inc.php")
            ->addTemplate("home/informacoes.php", ['processo' =>$processo ])
            ->addTemplate("footer.php");


        
        return $response->html($tpl->renderTemplate());




        //$soap = SoapWrapper::soap_criar_consulta_totvs("https://fundacaouniversitaria151485.rm.cloudtotvs.com.br:8051/wsConsultaSQL/MEX?wsdl", 'webserver', 'fjklçaJWWRYA$%us', true);
        //$out = SoapWrapper::soap_call_funcao($soap, 'EDUSQL.001', 'RealizarConsultaSQLContexto', 1, "CODCOLIGADA=1;IDPROCESSOSELETIVO=149;CPF=41094143855");
        //var_dump($out->Resultado);

       /*
        global $config;
            $tpl = new Tpl($config);

        $tpl->LoadTemplate("header.php", ["titulo" => "PAPAP"]);
        $tpl->LoadTemplate("home/index2.php");
        $tpl->LoadTemplate("footer.php");
        return;*/



    }

    #[RouteAttribute('/resultado', 'GET|POST')]
    public function listar_resultados(Request $request, Response $response) : Response {

        global $config;
        $tpl = new Tpl($request, $config);
        \App\Core\DB::get();

        if($request->isPost()){
            $post = $request->getParsedBody();

            $processo_id = (int)$post['processo'] ?? null;

            if(!$processo_id){
                $_SESSION['aviso']['titulo'] = "Houve um problema!";
                $_SESSION['aviso']['mensagem'] = "Selecione um processo Corretamente!";
                $response->redirect("/resultado",302)->send();
                return $response->text("");
            }

            if(!\is_numeric($post['cpf']) || !isset($post['cpf'])){
                $_SESSION['aviso']['titulo'] = "problema no CPF";
                $_SESSION['aviso']['mensagem'] = "Por Favor Adicione um CPF Válido!";
                $response->redirect("/resultado",302)->send();
                return $response->text("");
            }


            $processo = \App\Model\ProcessoView::where('idprocesso','=', $processo_id)
                                                     ->first(); 




            $_SESSION['resultado'] = [
                'id'          => $processo->idprocesso,
                'processo_id' => $processo->id_totvs,
                'cpf'         => $post['cpf'],
                'coligada'    => $processo->coligada_totvs,
                'ensino'      => $processo->fk_ensino,
                'curso'       => $processo->fk_curso
            ];
            
            \setcookie('resultado', 'true', [
                'expires' => time() + (8 * 60), //8 mins
                'path'    => '/',
                'domain'  => '',
                'secure'  => false,
                'httponly' => true,
                'samesite' => 'Lax'
            ]);

            $response->redirect("/resultado_candidato",302)->send();
            return $response->html("");
        }

        $processos = new \App\Model\ProcessoView();
        //$processos->where('habilitar_resultado','=', 1)
        //          ->whereNull('deletado_em');
                  
     

        $tpl->addTemplate("header.php", ['titulo' => "RESULTADOS"])
            ->addTemplate("partes/menu.inc.php")
            ->addTemplate("partes/banner.inc.php")
            ->addTemplate("home/resultado.php", ['processos' => $processos]);
        
            if(isset($_SESSION['aviso'])){
                $tpl->addTemplate('partes/modal_aviso.php', [
                    'titulo'   => isset($_SESSION['aviso']['titulo']) ? $_SESSION['aviso']['titulo'] : "Aviso!",
                    'mensagem' => isset($_SESSION['aviso']['mensagem']) ? $_SESSION['aviso']['mensagem'] : "ocorreu um problema!"
                
                ]);
                
                unset($_SESSION['aviso']);
            }

            $tpl->addTemplate("footer.php");

  
        if(isset($_SESSION['aviso'])) unset($_SESSION['aviso']);

        return $response->html($tpl->renderTemplate());

    }

    #[MiddlewareAttribute(\App\Middleware\AcessoResultado::class)]
    #[RouteAttribute('/resultado_candidato', 'GET', is_regex: true)]
    public function resultado_aluno(Request $request, Response $response) : Response {

        global $config;
        $tpl = new Tpl($request, $config);
        \App\Core\DB::get();


        $totvs = new WebHookTOTVS();

        $id          = (int)$_SESSION['resultado']['id'];
        $processo_id = (int)$_SESSION['resultado']['processo_id'];
        $cpf =         $_SESSION['resultado']['cpf'];
        $coligada    = (int)$_SESSION['resultado']['coligada']; 
        $ensino      = (int)$_SESSION['resultado']['ensino'];
        $candidato = null;



        $processo = \App\Model\ProcessoSeletivo::where('idprocesso', $id)
                                                ->first();
        
        if(!isset($_SESSION['resultado']['candidato'])){
             $candidato = $totvs->consultaResultadoProcessoSeletivo($coligada, $processo_id, $cpf);
            $_SESSION['resultado']['candidato'] = $candidato;
        }else {
            $candidato = $_SESSION['resultado']['candidato'];
        }
       
        $curso =        (int)$_SESSION['resultado']['curso'];

        $template_aprovado = "";

        if(!$candidato){
            $_SESSION['aviso']['titulo'] = "Ops!";
            $_SESSION['aviso']['mensagem'] = "CPF Não Encontrado no Processo Seletivo:{$processo->nome}";
            $response->redirect("/resultado")->send();
            if(isset($_SESSION['resultado'])) unset($_SESSION['resultado']);
            return $response->html("");
        }

        switch($totvs->candidatoStatus($ensino, $candidato)){
            case WebHookTOTVS::CANDIDATO_APROVADO:
                if($curso != 2){
                    $template_aprovado = "home/candidato_aprovado.php";
                }else {
                    $template_aprovado = "home/candidato_medicina_aprovado.php";
                }
                break;
            case WebHookTOTVS::CANDIDATO_ERRO:
                $template_aprovado = "home/candidato_erro.php";
                break;

            case WebHookTOTVS::CANDIDATO_EM_ESPERA:
                $template_aprovado = "home/candidato_em_espera.php";
                break;

            default:
                $template_aprovado = "partes/candidato_erro.inc.php";
                break;

        }


        if(!$processo){
            $_SESSION['aviso']['titulo'] = "Houve um problema!";
            $_SESSION['aviso']['mensagem'] = "Processo Seletivo esta incorreto.";
            $response->redirect("/resultado")->send();
            if(isset($_SESSION['resultado'])) unset($_SESSION['resultado']);
            return $response->html("");
        }

        $tpl->addTemplate("header.php", ['titulo' => "RESULTADO DO PROCESSO SELETIVO"])
            ->addTemplate("partes/menu.inc.php");

        $tpl->addTemplate($template_aprovado, ['candidato' => (object)$candidato, 
                                               'processo' => $processo]);
        $tpl->addTemplate("partes/documentos_modal.inc.php");
        $tpl->addTemplate("footer.php");
            



        return $response->html($tpl->renderTemplate());

    }
}