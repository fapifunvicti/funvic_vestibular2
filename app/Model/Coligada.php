<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Coligada extends Model {

    protected $table = "coligada";
    protected $primaryKey = 'idcoligada';
    protected $fillable = [ 'nome', 'ativo', 'inserido_em', 'atualizado_em', 'deletado_em'];
    public $timestamps = false;

}