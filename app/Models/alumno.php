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
}
