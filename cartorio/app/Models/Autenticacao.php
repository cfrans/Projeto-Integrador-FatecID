<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autenticacao extends Model
{

    protected $table = 'autenticacao';
    protected $fillable = [
            'valor','data_autenticacao', 'numero_cheque','agencia','banco','id_usuario','id_protocolo','id_forma_pagamento'
        ];

    public function usuario() {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function protocolo() {
        return $this->belongsTo(Protocolo::class, 'id_protocolo');
    }

    public function forma_pagamento() {
        return $this->belongsTo(FormaPagamento::class, 'id_forma_pagamento');
    }
}
