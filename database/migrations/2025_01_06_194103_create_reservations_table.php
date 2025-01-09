<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('bike_id')->constrained('bikes')->onDelete('cascade');
            $table->foreignId('start_station_id')->constrained('stations')->onDelete('cascade');
            $table->foreignId('end_station_id')->nullable()->constrained('stations')->onDelete('set null');
            $table->timestamp('reservation_time'); // Date et heure de réservation
            $table->timestamp('return_time')->nullable(); // Date et heure de retour
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
