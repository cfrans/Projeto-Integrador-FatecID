<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Andamento extends Model
{
    protected $fillable = [
        'data_hora','valor', 'observacao', 'id_tipo_andamento', 'tipo_andamento','id_usuario','id_protocolo'
    ];

    public function tipoAndamento() {
        return $this->belongsTo(TipoAndamento::class, 'id_tipo_andamento');
    }

    public function usuario() {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function protocolo() {
        return $this->belongsTo(Protocolo::class, 'id_protocolo');
    }

}
