<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = [
        'dni',
        'ruc',
        'razon_social', // Added
        'nombres',
        'apellidos',
        'email',
        'celular',
        'colegio_departamental',
        'departamento',
        'provincia',
        'distrito',
        'direccion_actual',
        'categoria_participante',
        'modalidad_participante',
        'codigo_pago',
        'tipo_comprobante',
        'foto_voucher',
        'status',
    ];
}
