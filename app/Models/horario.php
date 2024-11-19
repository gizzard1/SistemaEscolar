<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class horario extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'turno',
        'day_week',
        'hora_inicio',
        'hora_fin'
    ];
    
}
