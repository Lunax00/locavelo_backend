<?php

namespace App\Http\Controllers;

use App\Models\TypeVelo;
use Illuminate\Http\Request;

class TypeVeloController extends Controller
{
    public function index()
    {
        return TypeVelo::all();
    }

    public function show($id)
    {
        return TypeVelo::findOrFail($id);
    }

    public function store(Request $request)
    {
        $typeVelo = TypeVelo::create($request->all());
        return response()->json($typeVelo, 201);
    }

    public function update(Request $request, $id)
    {
        $typeVelo = TypeVelo::findOrFail($id);
        $typeVelo->update($request->all());
        return response()->json($typeVelo, 200);
    }

    public function destroy($id)
    {
        $typeVelo = TypeVelo::findOrFail($id);
        $typeVelo->delete();
        return response()->json(['message' => 'TypeVelo deleted']);
    }
}
