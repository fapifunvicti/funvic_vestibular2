<?php


function formato_data(string $data = "now", ?string $fmt = null, ?string $output_fmt = null) : array {
    $dt  = null;

    if($fmt){
        $dt = DateTime::createFromFormat($fmt, $data, new DateTimeZone("America/Sao_Paulo"));
    }else {
        $dt = new DateTime($data, new DateTimeZone("America/Sao_Paulo"));
    }

    $formatter = new IntlDateFormatter('pt_BR', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
    $formatter->setPattern($output_fmt);
    $dt_final = $formatter->format($dt);
    return explode(" ",$dt_final);
}

function data_completa($data = null){
    if(!is_array($data)) throw new Exception("data precisa ser um array gerado por formato_data()", 1);
    return "{$data[0]}, {$data[1]} de {$data[2]} de {$data[3]}";
    
}


/*
function template_load(string $caminho, ?array $params) : string
{
    global $config;
    //$tpl = $config->root . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . $config->template . DIRECTORY_SEPARATOR . $caminho;

    if (!str_contains($caminho, ".php")) {
        $caminho .= ".php";
    }


    if($params === null){
        $params = ['config' => $config ];
    }else {
        $params['config'] = $config;
    }
    

    ob_start();

    extract($params);
    include $caminho;
    return ob_get_flush();
}

function template(string $caminho, ?array $params){
    return template_load($caminho, $params);
}


function template_get(string $caminho, ?array $params) : bool
{
    global $config;
    ///$tpl = $config->root . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . $config->template . DIRECTORY_SEPARATOR . $caminho;

    if (!is_file($caminho)) {
        throw new Exception("{$caminho} Não Existe", 1);
    }


    ob_start();

    if (!is_null($params)) {
        extract($params);
    }

    if (!str_contains(".php", $caminho)) {
        include $caminho . '.php';
    } else {
        include $caminho;
    }
    return ob_get_clean();
}
*/


function escape(?string $string = null) : string {
    return htmlentities($string === null ? "" : $string, ENT_COMPAT, "utf-8", false);
}

function h(?string $string = null){
    return escape($string);
}


function resultados_online(string $dominio, bool $debug = false){
    
    if($debug){
        return true;
    }

    $curl = curl_init($dominio);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($curl, CURLOPT_HEADER, true);
    curl_setopt($curl, CURLOPT_NOBODY, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);
    $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    if($response){ 
        return true;
    }


    return false;
}

function url_strip(string $url) : string {
    $url = parse_url($url);
    return "{$url['scheme']}://{$url['host']}";
}


function get_url(?string $url = null, ?bool $hide_url = false):string {
    global $config;

    if(!$url){
        return $config->url;
    }

    if($hide_url){
        return $url;
    }

    return $config->url . '/' . $url;
}