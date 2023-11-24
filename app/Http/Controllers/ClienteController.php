<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClienteResource;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        return response()->json(['clientes' => ClienteResource::collection(Cliente::with('pets')->get())]);
    }
    public function searchCliente(Request $request)
    {
        $query = $request->query('query'); 
        $type = $request->query('type');

        if ($type === 'nome') {
            $clientes = Cliente::where('nome', 'like', "%$query%")->get();
        } elseif ($type === 'telefone') {
            $clientes = Cliente::where('telefone', 'like', "%$query%")->get();
        } elseif ($type === 'cpf') {
            $clientes = Cliente::where('cpf', 'like', "%$query%")->get();
        } elseif ($type === 'pet') {
            $clientes = Cliente::query()->with('pets')->where('pets.nome', 'like', "%$query")->get();
        }

        return response()->json(['clients' => ClienteResource::collection($clientes)]);
    }

    public function store(Request $request)
    {
        Cliente::create($request->all());

        return response()->json(['mensagem' => "Deu certo"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente = Cliente::find($id);
        return response()->json($cliente);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cliente = Cliente::find($id);

        $cliente->update($request->all());

        return response()->json(['mensagem' => "Deu certo"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = Cliente::find($id);

        $cliente->delete();

        return response()->json(['mensagem' => "Deu certo deleted"]);
    }
}
