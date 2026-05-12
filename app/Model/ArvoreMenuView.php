<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ArvoreMenuView extends Model
{
    protected $table = 'view_arvore_menu';
    public $timestamps = false;
    public $primaryKey = 'idmenu';
    public $readonly = true;  // view não aceita escrita

    public function scopeRaiz($query)
    {
        return $query->where('nivel', 0);
    }

    public function scopeFilhosDe($query, int $paiId)
    {
        return $query->where('pai_id', '=', $paiId);
    }
}