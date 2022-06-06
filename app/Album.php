<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model
{
    //inserir dados
   

    //Definindo parametro para desconsiderar campos padroes created_at e update_at
	public $timestamps = false; 

    protected $table = 'album';
    protected $fillable = ['nome', 'ano'];
}

