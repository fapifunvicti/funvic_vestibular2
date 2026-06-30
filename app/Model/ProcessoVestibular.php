<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProcessoVestibular extends Model {

    protected $table = 'processo_vestibular';
    protected $primaryKey = ['idvestibular_fk','idprocesso_fk', 'ativo'];
    public $incrementing = false;

     public $timestamps = false;

    const CREATED_AT = 'inserido_em';
    const UPDATED_AT = 'alterado_em';

    protected $fillable = ['idvestibular_fk','idprocesso_fk', 'ativo'];

    public function vestibular()
    {
        return $this->belongsToMany(\App\Model\Vestibular::class, 'vestibular', 'idvestibular');
    }

    public function processo()
    {
        return $this->belongsToMany(\App\Model\ProcessoVestibular::class, 'processo', 'idprocesso');
    }

}