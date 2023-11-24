<?php

namespace App\Http\Controllers;

use App\Http\Resources\PetResource;
use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    
    public function index()
    {
        return response()->json(['pets' => PetResource::collection(Pet::all())]);
    }

    public function search(Request $request){
        $query = $request->query('query');
        $type = $request->query('type');

        if($type === 'nome'){
            $pet = Pet::where('nome', 'like', "%$query%")->get();
        }

        return response()->json(['pets' => PetResource::collection($pet)]);
    }
    

    public function store(Request $request)
    {
        Pet::create($request->all());

        return response()->json(['mensagem' => 'Deu bom']);
    }

    public function show(string $id)
    {
        $pet = Pet::find($id);

        return response()->json($pet);
    }

    public function update(Request $request, string $id)
    {
        $pet = Pet::find($id);

        $pet->update($request->all());

        return response()->json(['mensagem' => 'Deu bom']);
    }

    public function destroy(string $id)
    {
        $pet = Pet::find($id);
        $pet->delete();

        return response()->json(['mensagem' => 'Deu bom']);
    }
}
