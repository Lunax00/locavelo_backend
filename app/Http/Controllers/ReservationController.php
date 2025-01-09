<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        return Reservation::with('user', 'bike', 'startStation', 'endStation')->get();
    }

    public function show($id)
    {
        return Reservation::with('user', 'bike', 'startStation', 'endStation')->findOrFail($id);
    }

    public function store(Request $request)
    {
        $reservation = Reservation::create($request->all());

        $user = $reservation->user;
        $bikeTypePrice = $reservation->bike->typeVelo->price;
        $user->credits -= $bikeTypePrice;
        $user->save();

        return response()->json(['message' => 'Reservation created', 'reservation' => $reservation]);
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return response()->json(['message' => 'Reservation deleted']);
    }
}
