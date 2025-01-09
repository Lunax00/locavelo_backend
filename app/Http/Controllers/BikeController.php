<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use Illuminate\Http\Request;

class BikeController extends Controller
{
    public function index()
    {
        return Bike::with('typeVelo', 'station')->get();
    }

    public function show($id)
    {
        return Bike::with('typeVelo', 'station')->findOrFail($id);
    }

    public function store(Request $request)
    {
        $bike = Bike::create($request->all());
        return response()->json($bike, 201);
    }

    public function update(Request $request, $id)
    {
        $bike = Bike::findOrFail($id);
        $bike->update($request->all());
        return response()->json($bike, 200);
    }

    public function changeState(Request $request, $id)
    {
        $bike = Bike::findOrFail($id);
        $bike->state = $request->input('state');
        $bike->save();
        return response()->json(['message' => 'Bike state updated', 'bike' => $bike]);
    }

    public function destroy($id)
    {
        $bike = Bike::findOrFail($id);
        $bike->delete();
        return response()->json(['message' => 'Bike deleted successfully']);
    }
}
