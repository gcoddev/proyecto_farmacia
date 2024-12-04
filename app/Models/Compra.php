<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compras';
    protected $primaryKey = 'cod_compra';

    protected $fillable = [
        'cod_proveedor',
        'cod_usuario',
        'cod_producto',
        'cantidad',
        'fecha_compra'
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'cod_proveedor', 'cod_proveedor');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'cod_usuario', 'cod_usuario');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'cod_producto', 'cod_producto');
    }

    // public function precio()
    // {
    //     return $this->hasMany(PrecioCompra::class, 'cod_compra', 'cod_compra');
    // }

    public function precio()
    {
        return $this->hasOne(PrecioCompra::class, 'cod_compra', 'cod_compra');
    }
}
