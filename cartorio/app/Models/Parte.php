<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parte extends Model
{
    protected $fillable = [
        'id_tipo_parte',
        'identificacao',
    ];

    public function tipoParte()
    {
        return $this->belongsTo(TipoParte::class, 'id_tipo_parte');
    }

    public function protocolo()
    {
        return $this->belongsTo(Protocolo::class, 'id_protocolo');
    }
}
