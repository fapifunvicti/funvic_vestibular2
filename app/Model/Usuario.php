<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model {

    protected $table = 'usuario';
    protected $primaryKey = 'idcoligada';

    protected $fillable = ['email', 'senha', 'permissao', 'utlimo_login', 'inserido_em', 'alterado_em', 'deletado_em'];

}