<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Alumnos;
use App\Http\Livewire\Carreras;
use App\Http\Livewire\Horarios;
use App\Http\Livewire\Materias;
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
    
    Route::get('/', Alumnos::class)->name('/');
    Route::get('carreras', Carreras::class)->name('carreras');
    Route::get('horarios', action: Horarios::class)->name('horario');
    Route::get('materias', Materias::class)->name('materias');
    Route::get('usuarios', Usuarios::class)->name('usuarios');
});

require __DIR__.'/auth.php';
