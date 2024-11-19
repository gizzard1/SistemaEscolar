<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class maestro extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'grado',
        'user_id'
    ];

    public function usuario(){
        return $this -> hasOne(usuario::class, 'user_id');
    }
}
