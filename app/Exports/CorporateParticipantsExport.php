<?php

namespace App\Exports;

use App\Models\CorporateParticipant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CorporateParticipantsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return CorporateParticipant::latest()->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Razón Social',
            'DNI',
            'Nombres',
            'Apellidos',
            'Email',
            'Celular',
            'Departamento',
            'Provincia',
            'Distrito',
            'Dirección',
            'Colegio Departamental',
            'Categoría',
            'Modalidad',
            'Código Pago',
            'Estado',
            'Fecha de Registro'
        ];
    }

    public function map($p): array
    {
        return [
            $p->id,
            $p->razon_social,
            $p->dni,
            $p->nombres,
            $p->apellidos,
            $p->email,
            $p->celular,
            $p->departamento,
            $p->provincia,
            $p->distrito,
            $p->direccion,
            $p->colegio_departamental,
            $p->categoria_participante,
            $p->modalidad_participante,
            $p->codigo_pago,
            $p->status == 1 ? 'Activo' : 'Pendiente',
            $p->created_at->format('d/m/Y H:i')
        ];
    }
}
