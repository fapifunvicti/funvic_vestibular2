<?php 
namespace App\Controller\Admin;

use App\Attributes\MiddlewareAttribute;
use App\Attributes\RouteAttribute;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;



#[MiddlewareAttribute(\App\Middleware\AuthMiddleware::class)]
class AdminLogin extends Controller {

    #[RouteAttribute("/admin/login", method:"GET|POST")]
    public function index(Request $request, Response $response): Response {
        global $config;
        $tpl = new \App\Core\Template($request, $config);
        \App\Core\DB::get();


        if($request->isPost()){

            $post = $request->getParsedBody();

            if(!isset($post['email']) || !\filter_var($post['email'], \FILTER_VALIDATE_EMAIL) ){
                $_SESSION['aviso']['titulo'] = "E-mail Inválido";
                $_SESSION['aviso']['mensagem'] = "Por Favor E-Mail Corretamente";
                $response->redirect("/admin/login", 302)->send();
                return $response->html("");
            }


            $email = \trim($post['email']);
            $senha  = \trim($post['password']);


            $usuario = \App\Model\Usuario::where('email','=', $email)->first();

            if(!$usuario){
                $_SESSION['aviso']['titulo'] = "Erro";
                $_SESSION['aviso']['mensagem'] = "E-mail inválido ou senha invalida!";
                $response->redirect("/admin/login", 302)->send();
                return $response->html("");
            }

            if(!\password_verify($senha, $usuario->senha)){
                $_SESSION['aviso']['titulo'] = "Erro";
                $_SESSION['aviso']['mensagem'] = "E-mail inválido ou senha invalida!";
                $response->redirect("/admin/login", 302)->send();
                return $response->html("");
            }


            $_SESSION['admin']['time'] = time() + (10 * 60);
            $_SESSION['admin']['id'] = $usuario->idusuario;
            $_SESSION['admin']['permissao'] = $usuario->permissao;




            $response->redirect("/admin/menu", 302)->send();
            return $response->html("");
        }


        $tpl->addTemplate("admin/tpl/header.php", ['titulo' => "LOGIN"])
            ->addTemplate("login/index.php");

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
}