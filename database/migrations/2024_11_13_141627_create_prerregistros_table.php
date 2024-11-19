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
        Schema::create('prerregistros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('materia_id')->nullable()->constrained('materias');
            $table->foreignId('alumno_id')->nullable()->constrained('alumnos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prerregistros');
    }
};
