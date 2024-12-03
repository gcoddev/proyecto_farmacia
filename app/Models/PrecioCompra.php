<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrecioCompra extends Model
{
    protected $table = 'precio_compras';
    protected $primaryKey = 'cod_precio_compra';

    protected $fillable = [
        'cod_compra',
        'cod_producto',
        'precio_unitario',
        'stock',
        'fecha_caducidad',
    ];
}
