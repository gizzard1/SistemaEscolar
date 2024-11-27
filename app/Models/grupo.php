<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grupo extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'nombre',
        'semestre',
        'alumnos',
        'ciclo',
        'duracion',
        'carrera_id',
        'materia_id',
        'maestro_id',
        'room_id',
        'horario_id'
    ];
    
    public function carrera(){
        return $this -> belongsTo(carrera::class, 'carrera_id');
    }
    public function materia(){
        return $this -> belongsTo(materia::class, 'materia_id');
    }
    public function maestro(){
        return $this -> belongsTo(maestro::class, 'maestro_id');
    }
    public function salon(){
        return $this -> belongsTo(room::class, 'room_id');
    }
    public function horario(){
        return $this -> belongsTo(horario::class, 'horario_id');
    }
    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'grupos_alumnos', 'grupo_id', 'alumno_id');
    }

}
