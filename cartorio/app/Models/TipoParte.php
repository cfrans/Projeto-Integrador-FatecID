<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoParte extends Model
{

    protected $fillable = [
        'tipo',
        'id_natureza',
    ];

    public function natureza()
    {
        return $this->belongsTo(Natureza::class, 'id_natureza');
    }

    public function partes()
    {
        return $this->hasMany(Parte::class, 'id_tipo_parte');
    }
}
