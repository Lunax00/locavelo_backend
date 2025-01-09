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

    public function addCredits(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $credits = $request->input('credits', 0);
        $user->credits += $credits;
        $user->save();

        return response()->json(['message' => 'Credits added successfully', 'user' => $user]);
    }

    public function sanction($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'Sanctionné';
        $user->save();

        return response()->json(['message' => 'User sanctioned successfully', 'user' => $user]);
    }
}
