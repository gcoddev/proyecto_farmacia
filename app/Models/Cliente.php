<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'cod_cliente';

    protected $fillable = [
        'nombre_cli',
        'diagnostico',
        'telefono',
        'direccion',
    ];
}
