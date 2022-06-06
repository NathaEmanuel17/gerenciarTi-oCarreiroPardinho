<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faixas extends Model
{
    //Definindo parametro para desconsiderar campos padroes created_at e update_at
	public $timestamps = false; 

    protected $table = 'faixa_musica';
    protected $fillable = ['nome', 'duracao','album_id'];
}

