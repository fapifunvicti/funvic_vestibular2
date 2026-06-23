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


class VestibularAdmin extends Controller {

     #[RouteAttribute("/admin/vestibular", method: "GET|POST")]
     public function index(Request $request, Response $response) : Response {
        global $config;
        $tpl = new \App\Core\Template($request, $config);
        \App\Core\DB::get();

      

        if($request->isPost()){
                $post = $request->getParsedBody();
                $ativo = (int)$post['ativo'];
                $id =  (int)$post['id'];

                $now =  new DateTime('now');
                $vestibular = \App\Model\Vestibular::where('idvestibular', '=', $id)->first();
                $vestibular->deletado_em = (int)$ativo  ? null : $now->format("Y-m-d H:i:s");
                $vestibular->save();
                $response->redirect("/admin/vestibular", 302)->send();
                return $response->html("");
        }


        $vestibularModel =  \App\Model\Vestibular::all();
    

        $tpl->addTemplate("admin/tpl/header.php", ['titulo' => "VESTIBULAR"])
                ->addTemplate("admin/partes/topo.php", ['titulo' => "VESTIBULARES"])
                ->addTemplate("admin/partes/menu.php")
                ->addTemplate("admin/vestibular/index.php", ['vestibular' => $vestibularModel ])
                ->addTemplate("admin/tpl/footer.php");

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



        $vestibularModel = \App\Model\Vestibular::where('idvestibular', '=', $id)
                                                  ->first();
        
        if(!$vestibularModel){
            $response->redirect("/admin/vestibular", 302)->send();
            return $response->html("");
        }


        $processo = \App\Model\ProcessoView::where('vestibular_id', $id);



        $tpl->addTemplate("admin/tpl/header.php", ['titulo' => "PROCESSOS " . $vestibularModel->nome ])
        ->addTemplate("admin/partes/topo.php", ['titulo' => "PROCESSO ". $vestibularModel->nome])
        ->addTemplate("admin/partes/menu.php")
        ->addTemplate("admin/vestibular/processos_index.php", ['processo' => $processo ])
        ->addTemplate("admin/tpl/footer.php");




        return $response->html($tpl->renderTemplate());
    }

}