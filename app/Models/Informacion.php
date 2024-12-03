<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Informacion extends Model
{
    protected $table = 'informacion';
    protected $primaryKey = 'cod_info';

    protected $fillable = [
        'nombre',
        'logo',
        'descripcion',
        'historia',
        'titular',
        'nit',
        'contacto1',
        'contacto2',
        'contacto3',
        'atencion',
        'correo',
        'ubicacion',
    ];
}
