<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apresentante extends Model
{
    protected $fillable = [
        'id_documento', 'numero_documento', 'nome', 'numero_contato', 'email'
    ];

    public function documento() {
        return $this->belongsTo(Documento::class, 'id_documento');
    }
}
