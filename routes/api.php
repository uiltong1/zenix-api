<?php

Route::post('auth/login', 'api\AuthController@login'); //ROTA PARA FAZER LOGIN NO SISTEMA

//ATENDIMENTO
Route::get('atendimento', 'api\AtendimentoController@index'); //ROTA PARA LISTAR ATENDIMENTOS
Route::get('atendimento/{id}', 'api\AtendimentoController@index'); //ROTA PARA CONSULTAR ATENDIMENTO
Route::post('atendimento/create', 'api\AtendimentoController@create'); //ROTA PARA FAZER CRIAR ATENDIMENTO
Route::put('atendimento/update/{id}', 'api\AtendimentoController@update'); //ROTA PARA FAZER ATUALIZAR ATENDIMENTO
Route::delete('atendimento/destroy/{id}', 'api\AtendimentoController@destroy'); //ROTA PARA FAZER EXCLUIR ATENDIMENTO





/* ROTAS PROTEGIDAS POR AUTENTICAÇÃO */
Route::group(['middleware'=>['apiJwt']], function(){

//Usuários
Route::resource('user', 'UserController');
Route::get('users', 'api\UserController@index'); //ROTA PARA LISTAR USUÁRIOS CADASTRADOS
Route::post('register', 'api\UserController@registerUser'); //ROTA PARA REGISTRO DE NOVOS FUNCIONARIOS
Route::get('users/{id}/edit', 'api\UserController@edit');
Route::put('users/{id}/toggle', 'api\UserController@toggle');
Route::put('users/update/{id}', 'api\UserController@update');
Route::get('users/show/{id}', 'api\UserController@show');
Route::get('users/search', 'api\UserController@search');
Route::get('users/export', 'api\UserController@export');


//Seguradoras
Route::get('seguradoras', 'api\SeguradorasController@index');
Route::post('seguradoras', 'api\SeguradorasController@store');
Route::get('seguradoras/{id}/edit', 'api\SeguradorasController@edit');
Route::put('seguradoras/{id}/toggle', 'api\SeguradorasController@toggle');
Route::put('seguradoras/update/{id}', 'api\SeguradorasController@update');
Route::get('seguradoras/show/{id}', 'api\SeguradorasController@show');
Route::get('seguradoras/search', 'api\SeguradorasController@search');

//Status de vendas
Route::get('status_vendas', 'api\StatusVendaController@index');
Route::post('status_vendas', 'api\StatusVendaController@store');
Route::put('status_vendas/update/{id}', 'api\StatusVendaController@update');
Route::get('status_vendas/show/{id}', 'api\StatusVendaController@show');
Route::get('status_vendas/{id}/edit', 'api\StatusVendaController@edit');
Route::put('status_vendas/{id}/toggle', 'api\StatusVendaController@toggle');
// Route::get('users/search', 'api\UserController@search');

//Tipos de planos
Route::get('tipos_planos', 'api\TiposPlanosController@index');
Route::post('tipos_planos', 'api\TiposPlanosController@store');
Route::put('tipos_planos/update/{id}', 'api\TiposPlanosController@update');
Route::get('tipos_planos/show/{id}', 'api\TiposPlanosController@show');
Route::get('tipos_planos/{id}/edit', 'api\TiposPlanosController@edit');
Route::put('tipos_planos/{id}/toggle', 'api\TiposPlanosController@toggle');

Route::resource('planos', 'api\PlanosController');
Route::put('planos/update/{id}', 'api\PlanosController@update');
Route::put('planos/{id}/toggle', 'api\PlanosController@toggle');














Route::post('auth/logout', 'api\AuthController@logout'); //ROTA PARA SAIR DO SISTEMA
Route::apiResource('pessoas','api\PessoaController'); //ROTA PARA CONSULTAR DADOS PESSOAIS DE USUÁRIOS
Route::post('pessoa/create', 'api\PessoaController@create'); //ROTA PARA INSERIR DADOS PESSOAIS DE USUÁRIOS
Route::post('pessoa/update/{id}','api\PessoaController@update'); //ROTA PARA ALTERAR DADOS PESSOAIS DE USUÁRIOS
Route::delete('pessoa/delete/{id}','api\PessoaController@destroy'); //ROTA PARA EXCLUIR DADOS PESSOAIS DE USUÁRIOS
});

