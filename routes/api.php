<?php

use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/produtos',[ProdutoController::class, 'index']);
Route::post('/produtos/cadastro',[ProdutoController::class, 'store']);
Route::delete('/produtos/delete',[ProdutoController::class,'delete']);
Route::put('/produtos/editar',[ProdutoController::class,'editar']);
Route::get('/produtos/all',[ProdutoController::class,'retornarTodos']);

// Clientes

Route::get('/clientes',[ClienteController::class, 'index']);
Route::post('/clientes/cadastro',[ClienteController::class, 'store']);
Route::delete('/clientes/delete',[ClienteController::class,'delete']);
Route::put('/clientes/editar',[ClienteController::class,'editar']);
Route::get('/clientes/all',[ClienteController::class,'retornarTodos']);
Route::put('cliente/senha',[ClienteController::class,'recuperarSenha']);

//Carrinho
Route::get('/carrinho',[CarrinhoController::class, 'index']);
Route::post('/carrinho/cadastro',[CarrinhoController::class, 'store']);
Route::put('/carrinho/editar',[CarrinhoController::class,'editar']);
Route::post('/pedido/cadastro2',[CarrinhoController::class, 'store2']);