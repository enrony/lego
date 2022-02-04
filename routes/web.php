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
    return view('welcome');
});

Route::apiResource('usuarios', 'UsuariosController', ['except'=>'show', 'create', 'edit']);

Route::prefix('usuarios')->group(function () {
    Route::get('/lista', 'UsuariosController@index');
    Route::post('/store', 'UsuariosController@store');
});
Route::prefix('categorias')->group(function () {
    Route::get('/lista', 'CategoriesController@index');
});