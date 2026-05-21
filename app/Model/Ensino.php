<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ensino extends Model {

    protected $table = "tipo_ensino";
    protected $primaryKey = 'idensino';
    protected $fillable = [ 'nome', 'inserido_em', 'atualizado_em', 'deletado_em'];

}