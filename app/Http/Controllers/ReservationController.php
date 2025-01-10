<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // Historique avec filtres
    public function history(Request $request)
    {
        $query = Reservation::with(['user', 'bike', 'startStation', 'endStation']);

        // Filtrer par date
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('reservation_time', [$request->start_date, $request->end_date]);
        }

        // Filtrer par type de vélo
        if ($request->has('type_velo')) {
            $query->whereHas('bike.type', function ($q) use ($request) {
                $q->where('name', $request->type_velo);
            });
        }

        // Filtrer par station
        if ($request->has('station_id')) {
            $query->where('start_station_id', $request->station_id)
                  ->orWhere('end_station_id', $request->station_id);
        }

        // Filtrer par utilisateur
        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $reservations = $query->get();

        return response()->json($reservations);
    }

    // Supprimer une réservation
    public function destroy($id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found.'], 404);
        }

        $reservation->delete();

        return response()->json(['message' => 'Reservation deleted successfully.']);
    }
}
