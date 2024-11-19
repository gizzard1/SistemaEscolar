<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materias_maestro extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'materia_id',
        'maestro_id',
        
    ];

    public function materia(){
        return $this -> hasOne(materia::class, 'materia_id');
    }
    public function maestro(){
        return $this -> hasOne(maestro::class, 'maestro_id');
    }
}
