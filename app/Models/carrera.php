<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carrera extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'nombre',
        'semestres'
    ];

    public function alumnos()
    {
        return $this->hasMany(alumno::class,'carrera_id');
    }

    public function maestros()
    {
        return $this->hasMany(maestro::class,'carrera_id');
    }

}
