<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('app.index');
});

Route::post('/adicionar', 'AlbumFaixaController@adicionar')->name('adicionar');
Route::post('/pesquisar', 'AlbumFaixaController@pequisar')->name('pesquisar'); 
Route::post('/buscarAlbum', 'AlbumFaixaController@buscar')->name('buscarAlbum');