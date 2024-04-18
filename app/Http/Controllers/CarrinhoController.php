<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarrinhoFormRequest;
use App\Models\Carrinho;
use App\Models\Item_carrinho;
use App\Models\Pedidos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarrinhoController extends Controller
{
    public function index()
    {


        $carrinho = DB::table('clientes')
            ->join('carrinhos', 'clientes.id', '=', 'carrinhos.clientes_id')
            ->join('item_carrinhos', 'carrinhos.id', '=', 'item_carrinhos.carrinho_id')
            ->join('produtos', 'produtos.id', 'item_carrinhos.produtos_id')
            ->get();
        //dd($carrinho);



        $carrinho = [
            'cliente_id' => $carrinho->cliente_id,
            'quantidade'=> $carrinho->quantidade,
            'valor_unitario'=>$carrinho->valor_unitario,
            'itens' => [
                [
                    'produtos_id' => $carrinho->produtos_id,
                    'nome' => $carrinho->nome,
                    'preco'=>$carrinho->preco,
                    'ingredientes'=>$carrinho->ingredientes,
                    'imagem'=>$carrinho->imagem
                ],
            ]
        ];
    }
    public function store(CarrinhoFormRequest $request)
    {
        $carrinho = Carrinho::where('clientes_id', $request->clientes_id);

        if (!$carrinho) {
            return response()->json([
                "status" => false,
                "message" => "cliente não encontrado"
            ], 400);
        }
        $carrinho =  Carrinho::create([
            'status' => $request->status,
            'clientes_id' => $request->clientes_id,
            'total' => $request->total,
        ]);
        return response()->json([
            "status" => true,
            "message" => "pedido feito com sucesso",
            "data" => $carrinho

        ], 200);
    }
    public function editar(Request $request)
    {
        $carrinho = Carrinho::find($request->id);
        if (!isset($carrinho)) {
            return response()->json([
                'status' => false,
                'message' => "Pedido não encontrado"
            ]);
        }
        if (isset($request->clientes_id)) {
            $carrinho->clientes_id = $request->clientes_id;
        }
        if (isset($request->produtos_id)) {
            $carrinho->produtos_id = $request->produtos_id;
        }
        if (isset($request->status)) {
            $carrinho->status = $request->status;
        }
        if (isset($request->total)) {
            $carrinho->total = $request->total;
        }
        $carrinho->update();
        return response()->json([
            'status' => true,
            'message' => 'Pedido atualizado.'
        ]);
    }
    public function store2(Request $request)
    {
        $carrinho = Item_carrinho::where('produtos_id', $request->produtos_id);
        if (!$carrinho) {
            return response()->json([
                "status" => false,
                "message" => "produto não encontrado"
            ], 400);
        }
        $carrinho = Item_carrinho::where('carrinho_id', $request->carrinho_id);
        if (!$carrinho) {
            return response()->json([
                "status" => false,
                "message" => "Pedido não encontrado"
            ], 400);
        }
        $carrinho =  Item_carrinho::create([


            'quantidade' => $request->quantidade,
            'carrinho_id' => $request->carrinho_id,
            'produtos_id' => $request->produtos_id,
            'valor_unitario' => $request->valor_unitario,
        ]);
        return response()->json([
            "status" => true,
            "message" => "pedido feito com sucesso",
            "data" => $carrinho

        ], 200);
    }

    public function index2()
    {
        $carrinho = Item_carrinho::all();

        $fotosComImagen = $carrinho->map(function ($carrinho) {
            return [
                'carrinho_id' => $carrinho->carrinho_id,
                'produtos_id' => $carrinho->produtos_id,
                'quantidade' => $carrinho->quantidade,
                'valor_unitario' => $carrinho->valor_unitario
            ];
        });
        return response()->json($fotosComImagen);
    }
}
