<?php 
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $table    = 'menu_item';
    protected $fillable = ['pai_id', 'nome', 'url', 'ordem', 'ativo'];

    const CREATED_AT = 'inserido_em';
    const UPDATED_AT = 'alterado_em';

    // filhos diretos
    public function filhos()
    {
        return $this->hasMany(MenuItem::class, 'pai_id')->orderBy('ordem');
    }

    // pai
    public function pai()
    {
        return $this->belongsTo(MenuItem::class, 'pai_id');
    }

    // somente itens raiz
    public function scopeRaiz($query)
    {
        return $query->whereNull('pai_id')->orderBy('ordem');
    }
}