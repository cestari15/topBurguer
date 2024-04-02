<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(){
        $produtos = Produto::all();

        $produtosComImagen = $produtos->map(function($produto){
            return [
                'nome'=>$produto->nome,
                'preco'=> $produto->preco,
                'ingredientes'=>$produto->ingredientes,
                'imagen'=> asset('storage/' . $produto->imagen)
            ];
        });
        return response()->json($produtosComImagen);
    }

    public function store(Request $request){
        $produtoData = $request->all();

        if($request->hasFile('imagem')){
            $imagem = $request->file('imagem');
            $nomeImagem = time().'.'.$imagem->getClientOriginalExtension();
            $caminhoImagem = $imagem->storeAs('imagens/produtos',$nomeImagem,'public');
            $produtoData['imagem'] = $caminhoImagem;
        }

        $produto = Produto::create($produtoData);

        return response()->json(['produto'=>$produto],201);
    }
}