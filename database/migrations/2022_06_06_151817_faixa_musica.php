<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FaixaMusica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //colunas
        Schema::create('faixa_musica', function (Blueprint $table) {
            //colunas
            $table->increments('id');
            $table->string('nome', 50);
            $table->string('duracao', 5);

            //constraint
            $table->integer('album_id')->unsigned();
            $table->foreign('album_id')->references('id')->on('album');  
        });
    }

    /**
     * 
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faixa_musica');
    }
}
