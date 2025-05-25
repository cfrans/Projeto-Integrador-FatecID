<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoAndamento extends Model
{

    protected $table = 'tipo_andamento';
    protected $fillable = [
        'tipo', 'possui_valor'
    ];

    public function andamento() {
        return $this->hasMany(Andamento::class, 'id_tipo_andamento');
    }
}
