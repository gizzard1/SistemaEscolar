<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alumno extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'nombre',
        'apellido_materno',
        'apellido_paterno',
        'estado',
        'fecha_nacimiento',
        'carrera_id',
        'user_id'
    ];

    public function usuario(){
        return $this ->belongsTo(User::class, 'user_id');
    }
    public function materiasRegistradas()
    {
        return $this->belongsToMany(materia::class,'prerregistros','materia_id','alumno_id');
    }
    public function grupos()
    {
        return $this->belongsToMany(grupo::class,'grupos_alumnos','alumno_id','grupo_id');
    }
}
