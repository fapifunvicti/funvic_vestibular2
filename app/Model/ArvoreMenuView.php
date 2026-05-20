<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ArvoreMenuView extends Model
{
    protected $table = 'view_arvore_menu';
    public $timestamps = false;
    public $primaryKey = 'idmenu';
    public $readonly = true;  // view não aceita escrita



    
    public function scopeRaiz(Builder $query): Builder
    {
        return $query->where('nivel', 0);
    }

    public function scopeFilhosDe(Builder $query, int $paiId): Builder
    {
        return $query->where('pai_id', '=', $paiId);
    }
    
}