<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especie extends Model
{
    protected $table = 'especie';

     protected $fillable = [
        'tipo'
    ];
}
