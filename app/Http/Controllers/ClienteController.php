<?php

namespace App\Http\Controllers;

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
                'imagen' => asset('storage/' . $cliente->foto)
            ];
        });
        return response()->json($fotosComImagen);
    }

    public function store(Request $request)
    {
        $clienteData = $request->all();

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nomeFoto = time() . '.' . $foto->getClientOriginalExtension();
            $caminhoFoto = $foto->storeAs('imagens/produtos', $nomeFoto, 'public');
            $clienteData['foto'] = $caminhoFoto;
        }

        $clienteData = Cliente::create($clienteData);

        return response()->json(['cliente' => $clienteData], 201);
    }
}
