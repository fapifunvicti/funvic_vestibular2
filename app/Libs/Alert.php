<?php
namespace App\Libs;


class Alert {
    readonly \App\Core\Config $config;
    private \App\Core\Template $template;

    private string $path;

    private string $type = "success";

    public function __construct(\App\Core\Config $config, \App\Core\Template $template, string $path)
    {
        $this->config = $config;
        $this->template = $template;
        $this->path = $path;

        

      

    }    

    public function Alert(string $title, string $fmt, mixed ...$args): string {
        $msg = sprintf($fmt, $args);
        $params = [
            'titulo' => $title,
            'conteudo' => $msg,
            'tipo' => $this->type
        ];
        $this->template->addTemplate($this->path, $params);
        return $this->template->renderTemplate();
        
    }


    public static function Success(Alert $alert, string $type, string $title, string $fmt, mixed ...$args){
        $alert->type = $type;
        $tpl = $alert->Alert($title, $fmt, $args);

        
        if(!isset($_SESSION['alert'])){
            $_SESSION['alert'] = true;
             return $tpl;
        }

    }


    public static function Clear(){
        if(isset($_SESSION['alert'])){
            unset($_SESSION['alert']);
            return;
        }
    }

}