<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Alumnos;
use App\Http\Livewire\Carreras;
use App\Http\Livewire\Grupos;
use App\Http\Livewire\Horario;
use App\Http\Livewire\Horarios;
use App\Http\Livewire\Maestros;
use App\Http\Livewire\Materias;
use App\Http\Livewire\Planeacion;
use App\Http\Livewire\Salones;
use App\Http\Livewire\Usuarios;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/', Horario::class)->name('/');
    Route::get('carreras', Carreras::class)->name('carreras');
    Route::get('horarios', action: Horarios::class)->name('horario');
    Route::get('materias', Materias::class)->name('materias');
    Route::get('usuarios', Usuarios::class)->name('usuarios');
    Route::get('grupos', Grupos::class)->name('grupos');
    Route::get('salones', Salones::class)->name('salones');
    Route::get('alumnos', Alumnos::class)->name('alumnos');
    Route::get('planeacion', Planeacion::class)->name('planeacion');
    Route::get('maestros', Maestros::class)->name('maestros');
});

require __DIR__.'/auth.php';
