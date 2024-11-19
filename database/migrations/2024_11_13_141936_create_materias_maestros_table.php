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
        Schema::create('materias_maestros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('materia_id')->constrained('materias');
            $table->foreignId('maestro_id')->constrained('maestros');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materias_maestros');
    }
};
