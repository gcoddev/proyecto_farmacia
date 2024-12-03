<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'cod_producto';

    protected $fillable = [
        'nombre_prod',
        'precio',
        'precio_caja',
        'presentacion',
        'cantidad',
        // 'stock',
        // 'fecha_caducidad',
        'cod_categoria',
    ];

    // Relacion foranea con Categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'cod_categoria', 'cod_categoria');
    }
}
