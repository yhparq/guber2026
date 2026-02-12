<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ponencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'ponente',
        'descripcion',
        'hora_inicio',
        'hora_fin',
        'dia',
        'link_video',
        'link_material',
        'archivo_material',
    ];
}
