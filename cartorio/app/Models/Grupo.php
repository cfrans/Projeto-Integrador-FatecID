<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = 'grupo';

     protected $fillable = [
        'tipo',
        'sequencia',
        'registro'
    ];
}
