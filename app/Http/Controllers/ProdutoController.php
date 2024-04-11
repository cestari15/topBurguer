<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoFormRequest;
use App\Http\Requests\ProdutoFormRequestUpdate;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
   public function index()
    {
        $produtos = Produto::all();

        $produtosComImagen = $produtos->map(function ($produto) {
            return [
                'id' => $produto->id,
                'nome' => $produto->nome,
                'preco' => $produto->preco,
                'ingredientes' => $produto->ingredientes,
                'imagem' => asset('storage/' . $produto->imagem)
            ];
        });
        return response()->json($produtosComImagen);
    }

    public function store(ProdutoFormRequest $request)
    {
        $produtoData = $request->all();

        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            $nomeImagem = time() . '.' . $imagem->getClientOriginalExtension();
            $caminhoImagem = $imagem->storeAs('imagens/produtos', $nomeImagem, 'public');
            $produtoData['imagem'] = $caminhoImagem;
        }

        $produto = Produto::create($produtoData);

        return response()->json(['produto' => $produto], 201);
    }

    public function delete($id)
    {
        $produto = Produto::find($id);

        if (!isset($cliente)) {
            return response()->json([
                'status' => false,
                'message' => "Produto não encontrado"
            ]);
        }

        $produto->delete();
        return response()->json([
            'status' => true,
            'message' => "Produto excluido com sucesso"
        ]);
    }

    public function editar(ProdutoFormRequestUpdate $request)
    {

        $produto = Produto::find($request->id);

        if (!isset($produto)) {
            return response()->json([
                'status' => false,
                'message' => "Produto não Sencontrado"
            ]);
        }

        if (isset($request->nome)) {
            $produto->nome = $request->nome;
        }

        if (isset($request->preco)) {
            $produto->preco = $request->preco;
        }

        if (isset($request->ingredientes)) {
            $produto->ingredientes = $request->ingredientes;
        }


        $produto->update();

        return response()->json([
            'status' => true,
            'message' => 'Produto atualizado.'
        ]);

    }
    public function retornarTodos(){
        $produto = Produto::all();

        if($produto == null){
            return response()->json([
                'status'=>false,
                'message'=>'Nenhum produto encontrado'
            ]);
        }
        return response()->json([
            'status'=>true,
            'data'=>$produto
        ]);
    }

    public function somar(Request $request){
        $produto = Produto::find($request->id);

        if(count($produto) == 0){
            return response()->json([
                'status' => false,
                'message' => "Nada no carrinho"
            ]);
        } 
          
        if(count($produto) > 0){
            
        }
    }

}
