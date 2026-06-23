<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Vestibular extends Model {
    protected $table    = 'vestibular';
    protected $primaryKey = 'idvestibular';
    protected $fillable = ['nome', 'data_prova', 'deletado_em'];

}