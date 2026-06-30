<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProcessoSeletivo extends Model {

    protected $table = "processo_seletivo";
    protected $primaryKey = 'idprocesso';
    protected $fillable = [ 'nome', 'fk_curso', 'fk_coligada', 'fk_ensino',
                            'data_prova', 'id_totvs', 'habilitar_resultado', 'data_resultado_inicio',
                            'data_resultado_fim', 'inserido_em', 'deletado_em', 'alterado_em',
                            'categoria', 'tipo_resultado', 'ordem'
    ];

    const CREATED_AT = 'inserido_em';
    const UPDATED_AT = 'alterado_em';

}