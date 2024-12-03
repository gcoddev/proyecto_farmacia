<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'cod_venta';

    protected $fillable = [
        'codigo',
        'cod_cliente',
        'cod_producto',
        'cantidad',
        'precio_unitario',
        'precio_total',
        'fecha_venta'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cod_cliente', 'cod_cliente');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'cod_producto', 'cod_producto');
    }
}
