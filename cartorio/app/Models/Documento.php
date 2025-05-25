<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{

    protected $table = 'documento';
    protected $fillable = [
        'tipo', 'classificacao'
    ];

    public function apresentante() {
        return $this->hasMany(Apresentante::class, 'id_documento');
    }
}

