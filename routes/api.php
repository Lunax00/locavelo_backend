<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Auth Controllers
use App\Http\Controllers\AuthController;

// Bike Controllers
use App\Http\Controllers\BikeController;

// Station Controllers
use App\Http\Controllers\StationController;

// Reservation Controllers
use App\Http\Controllers\ReservationController;

// TypeVelo Controllers
use App\Http\Controllers\TypeVeloController;

// User Controllers
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Routes publiques
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/stations', [StationController::class, 'index']);
Route::get('/station/{id}', [StationController::class, 'show']);
Route::get('/type-velos', [TypeVeloController::class, 'index']);


//publiques après privées
// Stations
Route::post('/stations', [StationController::class, 'store']);
Route::put('/station/{id}', [StationController::class, 'update']);
Route::delete('/station/{id}', [StationController::class, 'destroy']);

// Types de vélos
Route::post('/type-velos', [TypeVeloController::class, 'store']);
Route::put('/type-velos/{id}', [TypeVeloController::class, 'update']);
Route::delete('/type-velos/{id}', [TypeVeloController::class, 'destroy']);

// Vélos
Route::get('/bikes', [BikeController::class, 'index']);
Route::post('/bikes', [BikeController::class, 'store']);
Route::put('/bikes/{id}', [BikeController::class, 'update']);
Route::delete('/bikes/{id}', [BikeController::class, 'destroy']);

// Réservations
Route::get('/reservations/history', [ReservationController::class, 'history']);
Route::delete('/reservations/{id}', [ReservationController::class, 'destroy']);

// Utilisateurs
Route::get('/users', [UserController::class, 'index']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::post('/users/{id}/update-credits', [UserController::class, 'updateCredits']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
Route::post('/users/{id}/toggle-status', [UserController::class, 'toggleStatus']);



// Routes protégées par Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    
});

// Fallback route
Route::fallback(function () {
    return response()->json(['message' => 'Route not found'], 404);
});
