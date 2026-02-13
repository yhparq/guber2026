<?php

namespace App\Exports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ParticipantsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Participant::where('categoria_participante', '!=', 'Corporativo')->latest()->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'DNI',
            'Nombres',
            'Apellidos',
            'Email',
            'Celular',
            'Colegio Departamental',
            'Departamento',
            'Provincia',
            'Distrito',
            'Dirección Actual',
            'Categoría',
            'Modalidad',
            'Código Pago',
            'Tipo Comprobante',
            'Estado',
            'Fecha de Registro'
        ];
    }

    public function map($p): array
    {
        return [
            $p->id,
            $p->dni,
            $p->nombres,
            $p->apellidos,
            $p->email,
            $p->celular,
            $p->colegio_departamental,
            $p->departamento,
            $p->provincia,
            $p->distrito,
            $p->direccion_actual,
            $p->categoria_participante,
            $p->modalidad_participante,
            $p->codigo_pago,
            $p->tipo_comprobante,
            $p->status == 1 ? 'Activo' : 'Pendiente',
            $p->created_at->format('d/m/Y H:i')
        ];
    }
}
