<?php
namespace App\Libs;


use SimpleXMLElement;

class SoapWrapper {

    public static function soap_criar_consulta_totvs( #[\SensitiveParameter] string $wsdl_url,  #[\SensitiveParameter] string $login,  #[\SensitiveParameter] string $senha, bool $ssl=false): mixed {
        
        $parametros = [];    

        if($ssl){
            $parametros['local_cert'] = openssl_get_cert_locations()['default_cert_file'];
        }
        

        $url = parse_url($wsdl_url);    

        $parametros = [
            'endpoint' => $url['host'],
            'login' => $login,
            'password' => $senha,
            //'authentication' =>  SOAP_AUTHENTICATION_BASIC,
            'trace' => true,
            'exceptions' => true,
            'keep_alive' => true,
            'cache_wsdl'    => WSDL_CACHE_NONE,
        ];
        
        return new \SoapClient($wsdl_url, $parametros);
    }


    static public function soap_call_funcao(\SoapClient $soap, string $codSentenca, string $funcao = "RealizarConsultaSQLContexto", int $coligada = 1, string $parameters = "?"): SimpleXMLElement | bool {

        if(!$soap instanceof \SoapClient){
            throw new \Exception("Primeiro parametro deve ser uma instancia de Soap Client!",1);
        }

        $params = [
            'codSentenca' => $codSentenca,
            'codColigada' => $coligada,
            'codSistema' => 'S',
            'parameters' => $parameters,
            'context' => "CODCOLIGADA={$coligada}",
        
        ];

        try {
            $res = $soap->$funcao($params);
        }catch(\Exception $ex){
            return false;
        }

        return simplexml_load_string($res->RealizarConsultaSQLContextoResult);
    }


}