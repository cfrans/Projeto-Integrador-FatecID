<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Protocolo extends Model
{

    protected $table = 'protocolo';
    protected $fillable = [
        'numero_documento',
        'data_documento',
        'data_abertura', 
        'data_cancelamento',
        'numero_protocolo',
        'numero_registro',
        'data_registro',
        'data_retirada',
        'id_usuario',
        'id_apresentante',
        'id_grupo',
        'id_especie',
        'id_natureza',
    ];

    public function usuario() {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function apresentante() {
        return $this->belongsTo(Apresentante::class, 'id_apresentante');
    }

    public function grupo() {
        return $this->belongsTo(Grupo::class, 'id_grupo');
    }

    public function especie() {
        return $this->belongsTo(Especie::class, 'id_especie');
    }

    public function natureza() {
        return $this->belongsTo(Natureza::class, 'id_natureza');
    }
}

