<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StationController extends Controller
{
    public function index()
    {
        return Station::all();
    }

    public function show($id)
    {
        return Station::findOrFail($id);
    }

    

    
    // Avoir les vélos disponibles par station
    public function getAvailableBikeTypesByZone($stationId)
    {
        $bikeTypes = DB::table('bikes')
            ->join('type_velos', 'bikes.type_velo_id', '=', 'type_velos.id')
            ->join('stations', 'bikes.station_id', '=', 'stations.id')
            ->select(
                'type_velos.id as type_velo_id',
                'type_velos.name as type_velo_name',
                'type_velos.image as type_velo_image',
                'type_velos.price as type_velo_price',
                'type_velos.description as type_velo_description',
                DB::raw('COUNT(bikes.id) as available_bikes_count')
            )
            ->where('stations.id', $stationId)
            ->where('bikes.state', 'Disponible')
            ->groupBy(
                'type_velos.id',
                'type_velos.name',
                'type_velos.image',
                'type_velos.price',
                'type_velos.description'
            )
            ->get();

        return response()->json($bikeTypes);
    }



    public function destroy($id)
    {
        $station = Station::findOrFail($id);
        $station->delete();
        return response()->json(['message' => 'Station deleted successfully']);
    }
    public function store(Request $request) {
        $data = $request->all();
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $data['image'] = $filename;
        }
    
        Station::create($data);
        return response()->json(['message' => 'Station ajoutée avec succès']);
    }
    
    public function update(Request $request, $id) {
        $station = Station::findOrFail($id);
        $data = $request->all();
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $data['image'] = $filename;
        }
    
        $station->update($data);
        return response()->json(['message' => 'Station mise à jour avec succès']);
    }
    
}
