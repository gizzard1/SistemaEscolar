<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class maestro extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'apellido_materno',
        'apellido_paterno',
        'grado',
        'carrera_id',
        'user_id',
    ];

    public function usuario()
    {
        return $this -> hasOne(User::class, 'user_id');
    }
    public function grupos()
    {
        return $this->hasMany(grupo::class,'maestro_id');
    }
}
