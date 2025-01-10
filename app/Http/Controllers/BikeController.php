<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use Illuminate\Http\Request;

class BikeController extends Controller
{
    // Liste des vélos
    public function index()
    {
        $bikes = Bike::all();
        return response()->json($bikes);
    }

    // Ajouter un vélo
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type_velo_id' => 'required|exists:type_velos,id',
            'state' => 'required|string|in:Disponible,En réparation,Hors service',
            'station_id' => 'nullable|exists:stations,id',
        ]);

        $bike = Bike::create($validatedData);
        return response()->json($bike, 201);
    }

    // Voir un vélo spécifique
    public function show($id)
    {
        $bike = Bike::find($id);

        if (!$bike) {
            return response()->json(['message' => 'Vélo introuvable'], 404);
        }

        return response()->json($bike);
    }

    // Mettre à jour un vélo
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'type_velo_id' => 'sometimes|required|exists:type_velos,id',
            'state' => 'sometimes|required|string|in:Disponible,En réparation,Hors service',
            'station_id' => 'nullable|exists:stations,id',
        ]);

        $bike = Bike::find($id);

        if (!$bike) {
            return response()->json(['message' => 'Vélo introuvable'], 404);
        }

        $bike->update($validatedData);
        return response()->json($bike);
    }

    // Supprimer un vélo
    public function destroy($id)
    {
        $bike = Bike::find($id);

        if (!$bike) {
            return response()->json(['message' => 'Vélo introuvable'], 404);
        }

        $bike->delete();
        return response()->json(['message' => 'Vélo supprimé avec succès']);
    }
}
