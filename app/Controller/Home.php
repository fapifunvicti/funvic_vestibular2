<?php
namespace App\Controller;

use App\Attributes\Route;
use App\Core\Request;

use App\Core\Template as Tpl;
use App\Core\Response;
use App\Core\Controller;
use App\Core\DB;
use App\Middleware\SoapWrapper;

class Home extends Controller {

    #[Route("/", method:"GET|POST", is_regex: false)]
    public function index(Request $request, Response $response) : Response {
        global $config;
        $tpl = new Tpl($request, $config);

      if($request->isPost()){
            $capsule = DB::get();
            $tabela = $capsule->table('coligada')->select()->get();

            $post = $request->getParsedBody();
            var_dump($tabela);

            return $response->html(\serialize($post), 200);

      }


        $tpl->addTemplate("header.php", ['titulo' => "TESTE TITULO"])
            ->addTemplate("partes/menu.inc.php")
            ->addTemplate("partes/banner.inc.php")
            ->addTemplate("home/index.php")
            ->addTemplate("footer.php");

        return $response->html($tpl->renderTemplate(), 200);
        //return $response->html($tpl->renderTemplate(), 200);
    }

    #[Route("/hello2", 'GET')]
    public function hello2(Request $request, Response $response) : Response {

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
        return $response->html("");
    }


}