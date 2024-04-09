<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteFormRequest;
use App\Http\Requests\ClienteFormRequestUpdate;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    public function index()
    {
        $cliente = Cliente::all();

        $fotosComImagen = $cliente->map(function ($cliente) {
            return [
                'nome' => $cliente->nome,
                'telefone' => $cliente->telefone,
                'endereco' => $cliente->endereco,
                'email' => $cliente->email,
                'password' => Hash::make($cliente->password),
                'cpf'=>$cliente->cpf,
                'imagem' => asset('storage/' . $cliente->imagem)
            ];
        });
        return response()->json($fotosComImagen);
    }

    public function store(ClienteFormRequest $request)
    {
        $clienteData = $request->all();

        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            $nomeImagem = time() . '.' . $imagem->getClientOriginalExtension();
            $caminhoImagem = $imagem->storeAs('imagens/produtos', $nomeImagem, 'public');
            $clienteData['imagem'] = $caminhoImagem;
        }

        $clienteData = Cliente::create($clienteData);

        return response()->json(['cliente' => $clienteData], 201);
    }


    public function delete($id)
    {
        $cliente = Cliente::find($id);

        if (!isset($cliente)) {
            return response()->json([
                'status' => false,
                'message' => "Cliente não Sencontrado"
            ]);
        }

        $cliente->delete();
        return response()->json([
            'status' => true,
            'message' => "Cliente excluido com sucesso"
        ]);


    }

    public function editar(ClienteFormRequestUpdate $request)
    {

        $cliente = Cliente::find($request->id);

        if (!isset($cliente)) {
            return response()->json([
                'status' => false,
                'message' => "Usuario não Sencontrado"
            ]);
        }
        if (isset($request->cpf)) {
            $cliente->cpf = $request->cpf;
        }
        if (isset($request->nome)) {
            $cliente->nome = $request->nome;
        }

        if (isset($request->telefone)) {
            $cliente->telefone = $request->telefone;
        }

        if (isset($request->email)) {
            $cliente->email = $request->email;
        }

        if (isset($request->estado)) {
            $cliente->endereco = $request->endereco;
        }
     
        if (isset($request->password)) {
            $cliente->password = $request->password;
        }

        $cliente->update();

        return response()->json([
            'status' => true,
            'message' => 'Serviço atualizado.'
        ]);

    }

    public function pesquisarPorEmail(Request $request)
    {
        $cliente = Cliente::where('email', 'like', '%' . $request->email . '%')->get();

        if (count($cliente) > 0) {
            return response()->json([
                'status' => true,
                'data' => $cliente
            ]);
        }
        return response()->json([
            'status' => false,
            'menssagens' => 'Não há resultados para pesquisa'
        ]);
    }


    public function pesquisarPorCelular(Request $request)
    {
        $cliente = Cliente::where('telefone', 'like', '%' . $request->telefone . '%')->get();

        if (count($cliente) > 0) {
            return response()->json([
                'status' => true,
                'data' => $cliente
            ]);
        }
        return response()->json([
            'status' => false,
            'menssagens' => 'Não há resultados para pesquisa'
        ]);
    }


    public function recuperarSenha(Request $request)
    {

        $cliente = Cliente::where('email', '=', $request->email)->first();

        if (!isset($cliente)) {
            return response()->json([
                'status' => false,
                'message' => "Email invalido"

            ]);
        }

        if (isset($cliente->cpf)) {
           
            $cliente->password = Hash::make( $cliente->cpf );
            
        }
        $cliente->update();

        return response()->json([
            'status' => true,
            'password' => $cliente->password
        ]);
    }

}
