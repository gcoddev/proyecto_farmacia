<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
    protected $primaryKey = 'cod_categoria';

    protected $fillable = [
        'nombre_cat',
        'descripcion',
    ];
}
