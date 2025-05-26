<?php

use App\Http\Route;

/**
 * Rotas disponivéis;
 * O preiro parâmetro é a Rota em si
 * o sedundo é o nome do Controller e o métedo que deve ser chamado ao acessar essa rota
 * separados pelo @;
 * 
 */

Route::get('/', 'HomeController@index');
Route::post('/user/create', 'UserController@store');
Route::post('/user/login', 'UserController@login');
Route::get('/user/fetch', 'UserController@fetch');
Route::put('/user/update', 'UserController@update');
Route::delete('/user/{id}/delete', 'UserController@remove'); 

//OBS::
   //O {id} na rota /delete é apenas para fins de estudos, nunca se deve 
   //passar o id de um usuário pela url, deve ser pegado diretamente
   //no JWT.
