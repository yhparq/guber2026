<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CorporateParticipant extends Model
{
    protected $fillable = [
        'razon_social',
        'codigo_pago',
        'foto_voucher',
        'tipo_comprobante_pago',
        
        'dni',
        'nombres',
        'apellidos',
        'email',
        'celular',
        
        'departamento',
        'provincia',
        'distrito',
        'direccion',
        
        'colegio_departamental',
        'categoria_participante',
        'modalidad_participante',
        
        'tipo_comprobante_individual',
        'ruc_individual',
        
        'status',
    ];
}
