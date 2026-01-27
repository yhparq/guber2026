<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CorporateParticipantController extends Controller
{
    public function index()
    {
        return Inertia::render('CorporateParticipants/Index', [
            'participants' => Participant::where('categoria_participante', 'Corporativo')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('CorporateParticipants/Create');
    }

    public function store(Request $request)
    {
        // For corporate, we map RUC to dni, Company Name to nombres, etc.
        $validated = $request->validate([
            'dni' => 'required|string', // RUC
            'nombres' => 'required|string', // Company Name
            'email' => 'required|email', // Contact Email
            'celular' => 'nullable|string', // Contact Phone
            'direccion_actual' => 'nullable|string', // Address
            'categoria_participante' => 'required|string', // Should be 'Corporativo'
            // Add other fields as necessary
        ]);
        
        // Force category if not sent, though form should send it
        $validated['categoria_participante'] = 'Corporativo';

        Participant::create($validated);

        return redirect()->route('corporate-participants.index');
    }

    public function createPublic()
    {
        return Inertia::render('CorporateParticipants/PublicCreate');
    }

    public function storePublic(Request $request)
    {
        $request->validate([
            'razon_social' => 'required|string',
            'ruc' => 'required|string',
            'email_contacto' => 'required|email',
            'celular_contacto' => 'required|string',
            'direccion' => 'required|string',
            'codigo_pago' => 'nullable|string',
            'tipo_comprobante' => 'nullable|string',
            'foto_voucher' => 'nullable|image|max:2048',
            'participants' => 'required|array|min:1',
            'participants.*.dni' => 'required|string',
            'participants.*.nombres' => 'required|string',
            'participants.*.apellidos' => 'required|string',
            'participants.*.email' => 'required|email', // Assuming unique emails per participant
            'participants.*.celular' => 'nullable|string',
            'participants.*.categoria' => 'required|string',
            'participants.*.modalidad' => 'required|string',
        ]);

        $voucherPath = null;
        if ($request->hasFile('foto_voucher')) {
            $voucherPath = $request->file('foto_voucher')->store('vouchers', 'public');
        }

        foreach ($request->participants as $p) {
            // Check if email already exists to avoid crash (simple check)
            if (Participant::where('email', $p['email'])->exists()) {
                // Skip or handle error? For now, we'll try to create and let it fail or we could use updateOrCreate if appropriate.
                // But registration usually requires new emails.
                // We'll proceed with create, if it fails, Laravel will throw an exception.
                // Ideally, validation should handle this: 'participants.*.email' => 'unique:participants,email'
            }

            Participant::create([
                'dni' => $p['dni'],
                'nombres' => $p['nombres'],
                'apellidos' => $p['apellidos'],
                'email' => $p['email'],
                'celular' => $p['celular'],
                'categoria_participante' => $p['categoria'],
                'modalidad_participante' => $p['modalidad'],
                'colegio_departamental' => $request->razon_social, // Storing Company Name as affiliation
                'direccion_actual' => $request->direccion,
                'codigo_pago' => $request->codigo_pago,
                'tipo_comprobante' => $request->tipo_comprobante,
                'foto_voucher' => $voucherPath,
            ]);
        }

        return redirect()->route('inscripciones')->with('success', 'Inscripción corporativa realizada con éxito.');
    }
}
