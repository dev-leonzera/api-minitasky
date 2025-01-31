<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    private $client;

    public function __construct(Client $client )
    {
        $this->client = $client;
    }
    
    public function index()
    {
        $clients = $this->client->all();
        return response()->json($clients);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string',
            'email' => 'required|string|email|unique:clients',
            'fone' => 'required|string',
            'data_contrato' => 'required|date',
            'dia_vencimento' => 'required|integer',
            'ativo' => 'boolean',
            'mensalista' => 'boolean',
            'tipo' => 'required|in:pf,pj',
        ]);

        $client = $this->client->create($validatedData);
        return response()->json($client, 201);
    }

    public function show(string $id)
    {
        $client = $this->client->find($id);
        if (!$client) {
            return response()->json(['message' => 'Client not found'], 404);
        }
        return response()->json($client);
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nome' => 'sometimes|required|string',
            'email' => 'sometimes|required|string|email|unique:clients,email,' . $id,
            'fone' => 'sometimes|required|string',
            'data_contrato' => 'sometimes|required|date',
            'dia_vencimento' => 'sometimes|required|integer',
            'ativo' => 'sometimes|boolean',
            'mensalista' => 'sometimes|boolean',
            'tipo' => 'sometimes|required|in:pf,pj',
        ]);

        $client = $this->client->find($id);
        if (!$client) {
            return response()->json(['message' => 'Client not found'], 404);
        }

        $client->update($validatedData);
        return response()->json($client);
    }

    public function destroy(string $id)
    {
        $client = $this->client->find($id);
        if (!$client) {
            return response()->json(['message' => 'Client not found'], 404);
        }

        $client->delete();
        return response()->json(['message' => 'Client deleted successfully']);
    }
}
