<?php
namespace App\Controller;

use App\Attributes\RouteAttribute;
use App\Core\Request;

use App\Core\Template as Tpl;
use App\Core\Response;
use App\Core\Controller;
use App\Core\DB;
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

        $processo = \App\Model\ProcessoView::find((int)$args[0]);
        if(!$processo){
            $response->setStatusCode(404)->send();
            return $response->html("");
        }
        

        $tpl->addTemplate("header.php", ['titulo' => "TESTE TITULO"])
            ->addTemplate("partes/menu.inc.php")
            ->addTemplate("partes/banner.inc.php")
            ->addTemplate("home/informacoes.php", ['processo' => $processo->get()->first() ])
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

    #[RouteAttribute('/resultado', 'GET')]
    public function listar_resultados(Request $request, Response $response) : Response {

        global $config;
        $tpl = new Tpl($request, $config);
        \App\Core\DB::get();


        $processos = new \App\Model\ProcessoView();
        $processos->where('habilitar_resultado','>', 0)
                  ->whereNull('deletado_em');
                  
     

        $tpl->addTemplate("header.php", ['titulo' => "RESULTADOS"])
            ->addTemplate("partes/menu.inc.php")
            ->addTemplate("partes/banner.inc.php")
            ->addTemplate("home/resultado.php", ['processos' => $processos])
            ->addTemplate("footer.php");


        return $response->html($tpl->renderTemplate());

    }

    #[RouteAttribute('/resultado/{id:int}', 'GET', is_regex: true)]
    public function resultados(Request $request, Response $response) : Response {

        global $config;
        $tpl = new Tpl($request, $config);
        \App\Core\DB::get();
        $args = $request->get_uri_args();

        $tpl->addTemplate("header.php", ['titulo' => "TESTE TITULO"])
            ->addTemplate("partes/menu.inc.php")
            ->addTemplate("partes/banner.inc.php")
            ->addTemplate("home/resultado.php")
            ->addTemplate("footer.php");


        if(!isset($args[0])){

        }

        return $response->html("");

    }
}