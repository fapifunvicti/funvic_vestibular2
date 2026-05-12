<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CursoDisponivel extends Model {

    protected $table = "curso_disponivel";
    protected $primaryKey = 'idcursodisponivel';
    protected $fillable = [ 'nome', 'curso_fk', 'coligada_fk', 'ensino_fk', 'nome', 'periodo', 'area', 'disponivel', 'ativo'];

}