<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ProcessoView extends Model
{
    protected $table = 'view_processo_seletivo';
    public $timestamps = false;
    public $primaryKey = 'idprocesso';
    public $readonly = true;  // view não aceita escrita




    public function scopeTotalColigadas(Builder $query,  int $coligada_id){
        return $query->selectRaw("SELECT total_processos_coligadas(?) as total", [$coligada_id]);
    }

    
    public function scopeListarPorColigada(Builder $query, int $id): Builder
    {
        return $query->where('fk_coligada', '=', $id);
    }

    public function scopeListarPorCurso(Builder $query, int $id): Builder
    {
        return $query->where('fk_curso', '=', $id);
    }

    public function scopeListarPorEnsino(Builder $query, int $id): Builder
    {
        return $query->where('fk_ensino', '=', $id);
    }
    
}