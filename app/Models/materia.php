<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materia extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'asignatura',
        'creditos',
        'semestre',
        'carrera_id'
    ];

    public function carrera(){
        return $this -> belongsTo(carrera::class, 'carrera_id');
    }
    public function grupos()
    {
        return $this->hasMany(grupo::class);
    }
    public function alumnosRegistrados()
    {
        return $this->belongsToMany(alumno::class, 'prerregistros', 'materia_id', 'alumno_id');
    }
}
