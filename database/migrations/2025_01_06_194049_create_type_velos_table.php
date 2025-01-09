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
        Schema::create('type_velos', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nom du type de vélo
            $table->text('description')->nullable(); // Description du type de vélo
            $table->string('image')->nullable(); // URL ou chemin vers l'image
            $table->decimal('price', 8, 2); // Prix de location par unité
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_velos');
    }
};
