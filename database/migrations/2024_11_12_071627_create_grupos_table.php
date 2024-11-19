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
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('semestre');
            $table->integer('alumnos');
            $table->date('ciclo');
            $table->date('duracion');
            $table->foreignId('carrera_id')->constrained('carreras');
            $table->foreignId('materia_id')->constrained('materias');
            $table->foreignId('maestro_id')->constrained('maestros');
            $table->foreignId('room_id')->constrained('rooms');
            $table->foreignId('horario_id')->constrained('horarios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupos');
    }
};
