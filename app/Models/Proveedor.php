<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';
    protected $primaryKey = 'cod_proveedor';

    protected $fillable = [
        'nombre_prov',
        'telefono',
        'direccion',
    ];
}
