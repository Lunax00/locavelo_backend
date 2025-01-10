<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }
    
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json($user, 200);
    }

    public function updateCredits(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé.'], 404);
        }

        $validated = $request->validate([
            'credits' => 'required|numeric|min:0', // Les crédits doivent être un nombre positif
        ]);

        $user->credits = $validated['credits'];
        $user->save();

        return response()->json(['message' => 'Crédits mis à jour avec succès.', 'credits' => $user->credits], 200);
    }   
    public function toggleStatus($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé.'], 404);
        }

        // Basculer le statut entre Actif et Sanctionné
        $user->status = $user->status === 'Actif' ? 'Sanctionné' : 'Actif';
        $user->save();

        return response()->json(['message' => 'Statut mis à jour avec succès.', 'status' => $user->status], 200);
    }
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé.'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Utilisateur supprimé avec succès.'], 200);
    }

}
