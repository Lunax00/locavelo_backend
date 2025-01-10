<?php

namespace App\Http\Controllers;

use App\Models\TypeVelo;
use Illuminate\Http\Request;

class TypeVeloController extends Controller
{
    // Liste des types de vélos
    public function index()
    {
        $types = TypeVelo::all();
        return response()->json($types);
    }

    // Créer un nouveau type de vélo
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $typeVelo = TypeVelo::create($validatedData);
        return response()->json($typeVelo, 201);
    }

    // Afficher un type de vélo spécifique
    public function show($id)
    {
        $typeVelo = TypeVelo::find($id);

        if (!$typeVelo) {
            return response()->json(['message' => 'Type de vélo introuvable'], 404);
        }

        return response()->json($typeVelo);
    }

    // Mettre à jour un type de vélo
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric',
        ]);

        $typeVelo = TypeVelo::find($id);

        if (!$typeVelo) {
            return response()->json(['message' => 'Type de vélo introuvable'], 404);
        }

        $typeVelo->update($validatedData);
        return response()->json($typeVelo);
    }

    // Supprimer un type de vélo
    public function destroy($id)
    {
        $typeVelo = TypeVelo::find($id);

        if (!$typeVelo) {
            return response()->json(['message' => 'Type de vélo introuvable'], 404);
        }

        $typeVelo->delete();
        return response()->json(['message' => 'Type de vélo supprimé avec succès']);
    }
}
