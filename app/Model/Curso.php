<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model {
    protected $table = "curso"; 
    protected $primaryKey = 'idcurso';
    protected $fillable = ['idcurso', 'nome', 'ativo', 'criado_em', 'alterado_em', 'deletado_em'];
     public $timestamps = false;

}