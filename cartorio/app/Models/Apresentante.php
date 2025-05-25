<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apresentante extends Model
{

    protected $table = 'apresentante';
    protected $fillable = [
        'id_documento', 
        'numero_documento', 
        'nome', 
        'numero_contato', 
        'email',
        'tipo_contato'
    ];

    public function documento() {
        return $this->belongsTo(Documento::class, 'id_documento');
    }
}
