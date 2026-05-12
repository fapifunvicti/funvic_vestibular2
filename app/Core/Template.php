<?php
namespace App\Core;

use App\Core\Config;
use Exception;


final class Template {
    private Config $config;
    private Request $request;

    private array $template_content  = [];
    public function __construct(Request $request, Config $config)
    {
        $this->config = $config;
        $this->request = $request;
        
    }


    private function LoadTemplateToBuffer(string $path, ?array $parameters = null) : string|bool
    {
        $path = $this->config->template_path . \DIRECTORY_SEPARATOR . $path;

        if(!\is_file($path)){
            throw new Exception("Template: {$path} não encontrado");
        }

        if(\is_array($parameters) &&  $parameters){
            \extract($parameters, \EXTR_SKIP);
        }
    
        \ob_start();
        require $path;
        $tmp = \ob_get_contents();
        \ob_end_clean();
        return $tmp;
    } 

    public function LoadTemplate(string $path, array $parameters = []) : void {
        echo $this->LoadTemplateToBuffer($path, $parameters);
        return;
    }


    public function addTemplate(string $path, ?array $params = null): self {
        $this->template_content[] = $this->LoadTemplateToBuffer($path, $params);
        return $this;
    }

    public function renderTemplate(): string {
        $result = "";
        foreach ($this->template_content as $tpl){
             $result .= $tpl;    
        }

        return $result;
    }

    /*
    public function LoadTemplateToString(string $path,  array ...$parameters) : string|bool {
        $path = $this->config->template_path . \DIRECTORY_SEPARATOR . $path;

        if(!\is_file($path)){
            throw new Exception("Template: {$path} não encontrado");
        }

        if(count($parameters) > 0 ){
            \extract($parameters, \EXTR_SKIP);
        }
        
        
        \ob_start();
        include_once $path;
        $content = \ob_get_contents();
        \ob_end_clean();
        return $content;
    }*/



}