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
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Public routes
Route::post('/login', [AuthController::class, 'login']); // Login route
Route::post('/register', [AuthController::class, 'register']); // Register route
Route::get('/stations', [StationController::class, 'index']); // Liste toutes les stations
Route::get('/station/{id}', [StationController::class, 'show']); // Affiche une station spécifique
Route::post('/stations', [StationController::class, 'store']); // Ajoute une nouvelle station
Route::put('/station/{id}', [StationController::class, 'update']); // Met à jour une station existante
Route::delete('/station/{id}', [StationController::class, 'destroy']); // Supprime une station
// Protecting routes with Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']); // Logout route

    // Bikes routes
    Route::get('/bikes', [BikeController::class, 'index']);
    Route::get('/bike/{id}', [BikeController::class, 'show']);
    Route::post('/bikes', [BikeController::class, 'store']);
    Route::put('/bike/{id}', [BikeController::class, 'update']);
    Route::delete('/bike/{id}', [BikeController::class, 'destroy']);

    // Reservations routes
    Route::get('/reservations', [ReservationController::class, 'index']);
    Route::get('/reservation/{id}', [ReservationController::class, 'show']);
    Route::post('/reservations', [ReservationController::class, 'store']);
    Route::put('/reservation/{id}', [ReservationController::class, 'update']);
    Route::delete('/reservation/{id}', [ReservationController::class, 'destroy']);

    // TypeVelo routes
    Route::get('/type-velos', [TypeVeloController::class, 'index']);
    Route::get('/type-velo/{id}', [TypeVeloController::class, 'show']);
    Route::post('/type-velos', [TypeVeloController::class, 'store']);
    Route::put('/type-velo/{id}', [TypeVeloController::class, 'update']);
    Route::delete('/type-velo/{id}', [TypeVeloController::class, 'destroy']);

    // User-specific routes
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::post('/users/{id}/add-credits', [UserController::class, 'addCredits']);
    Route::get('/users/{id}/reservations', [UserController::class, 'reservations']);
});

// Fallback route for unauthorized users
Route::fallback(function () {
    return response()->json(['message' => 'Route not found'], 404);
});
// Route pour obtenir l'utilisateur connecté
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
