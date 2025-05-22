<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $fillable = [
        'tipo', 'classificacao'
    ];

    public function apresentantes() {
        return $this->hasMany(Apresentante::class, 'id_documento');
    }
}

