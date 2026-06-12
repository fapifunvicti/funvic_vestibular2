<?php
namespace App\Libs;


class WebHookTOTVS {

    private const totvs_webhook =  "https://fundacaouniversitaria151485.rm.cloudtotvs.com.br:8051";

    private array $consulta = [
        "wsConsulta" => "/wsConsultaSQL/MEX?wsdl"
    ];


    const TIPO_ENSINO_GERAL     = 1;

    const TIPO_ENSINO_MEDICINA  = 2;

    public const CANDIDATO_APROVADO = 1;
    public const CANDIDATO_ERRO = 2;
    public const CANDIDATO_EM_ESPERA = 3;
    

    public function consultaResultadoProcessoSeletivo(int $coligada, int $id_processo_seletivo, string $cpf): mixed {

            //aumenta o tempo do timeout (totvs é muito lento certas horas)
            $tempo_antigo = ini_get("default_socket_timeout");
            ini_set("default_socket_timeout", "300");

            $soap = \App\Libs\SoapWrapper::soap_criar_consulta_totvs(
                WebHookTOTVS::totvs_webhook . $this->consulta['wsConsulta'], "webserver", "fjklçaJWWRYA$%us", true
            );

            $result = \App\Libs\SoapWrapper::soap_call_funcao($soap, "EDUSQL.001", 'RealizarConsultaSQLContexto', $coligada,
                      "CODCOLIGADA={$coligada};IDPROCESSOSELETIVO={$id_processo_seletivo};CPF={$cpf}"
            
            );


            //ATENÇÂO: gambiarra para deserializar XML pois o objeto nao é serializavel e causam problemas com conversao e tambem afeta sessions
            //convertendo pr JSON e desconvertendo resolve o problema o objeto vira StdClass
            $candidato_resultado = \json_encode($result->Resultado);
            $candidato_resultado = json_decode($candidato_resultado, true);

            //restaura tempo antigo
            ini_set("default_socket_timeout", $tempo_antigo);
            
            return $candidato_resultado;

    }

    public function candidatoStatus(int $tipo_curso, mixed $candidato) : int {
        $ret = WebHookTOTVS::CANDIDATO_ERRO;

        $candidato = (object)$candidato;

        switch((int)$candidato->STATUS_APROVACAO){
            default:
            case 3:
            case 4:
                break;

            case 5: //aprovado
            case 7: //matriculado
                if($tipo_curso == WebHookTOTVS::TIPO_ENSINO_MEDICINA){
                    $_SESSION['resultado']['medicina'] = true;
                }else {
                    $ret =  $_SESSION['resultado']['medicina'] = false;
                }
                $ret =  WebHookTOTVS::CANDIDATO_APROVADO;
            break;

            case 10:
                $ret =  WebHookTOTVS::CANDIDATO_EM_ESPERA;
                break;
        }

        return $ret;
    }

}
