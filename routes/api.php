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
use Database\Seeders\TypeVeloSeeder;

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
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);


Route::get('/stations', [StationController::class, 'index']); // Liste toutes les stations
Route::get('/station/{id}', [StationController::class, 'show']); // Affiche une station spécifique
Route::post('/stations', [StationController::class, 'store']); // Ajoute une nouvelle station
Route::put('/station/{id}', [StationController::class, 'update']); // Met à jour une station existante
Route::delete('/station/{id}', [StationController::class, 'destroy']); // Supprime une station

//typesvelos

Route::get('/type-velos', [TypeVeloController::class, 'index']); // Liste des types de vélos
Route::post('/type-velos', [TypeVeloController::class, 'store']); // Créer un type de vélo
Route::get('/type-velos/{id}', [TypeVeloController::class, 'show']); // Afficher un type de vélo spécifique
Route::put('/type-velos/{id}', [TypeVeloController::class, 'update']); // Mettre à jour un type de vélo
Route::delete('/type-velos/{id}', [TypeVeloController::class, 'destroy']); // Supprimer un type de vélo


// velos:
Route::get('/bikes', [BikeController::class, 'index']); // Liste des vélos
Route::post('/bikes', [BikeController::class, 'store']); // Ajouter un vélo
Route::get('/bikes/{id}', [BikeController::class, 'show']); // Voir un vélo spécifique
Route::put('/bikes/{id}', [BikeController::class, 'update']); // Mettre à jour un vélo
Route::delete('/bikes/{id}', [BikeController::class, 'destroy']); // Supprimer un vélo

//reservations
// Historique avec filtres
Route::get('/reservations/history', [ReservationController::class, 'history']);

// Supprimer une réservation
Route::delete('/reservations/{id}', [ReservationController::class, 'destroy']);

// users

Route::get('/users', [UserController::class, 'index']); // Liste des utilisateurs
Route::put('/users/{id}', [UserController::class, 'update']); // Mettre à jour un utilisateur
// Mettre à jour les crédits d'un utilisateur
Route::post('/users/{id}/update-credits', [UserController::class, 'updateCredits']);

// Supprimer un utilisateur
Route::delete('/users/{id}', [UserController::class, 'destroy']);
Route::post('/users/{id}/toggle-status', [UserController::class, 'toggleStatus']); // Sanctionner/Désanctionner

// Fallback route for unauthorized users
Route::fallback(function () {
    return response()->json(['message' => 'Route not found'], 404);
});
// Route pour obtenir l'utilisateur connecté
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
