<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ParticipantController extends Controller
{
    public function index()
    {
        return Inertia::render('Participants/Index', [
            'participants' => Participant::where('categoria_participante', '!=', 'Corporativo')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Participants/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'dni' => 'nullable|string',
            'nombres' => 'required|string',
            'apellidos' => 'nullable|string',
            'email' => 'required|email',
            'celular' => 'nullable|string',
            'colegio_departamental' => 'nullable|string',
            'departamento' => 'nullable|string',
            'provincia' => 'nullable|string',
            'distrito' => 'nullable|string',
            'direccion_actual' => 'nullable|string',
            'categoria_participante' => 'required|string',
            'modalidad_participante' => 'nullable|string',
            'codigo_pago' => 'nullable|string',
            'tipo_comprobante' => 'nullable|string',
            'foto_voucher' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto_voucher')) {
            $path = $request->file('foto_voucher')->store('vouchers', 'public');
            $validated['foto_voucher'] = $path;
        }

        Participant::create($validated);

        return redirect()->route('participants.index');
    }

    public function createPublic()
    {
        return Inertia::render('Participants/PublicCreate');
    }

    public function storePublic(Request $request)
    {
        $validated = $request->validate([
            'dni' => 'required|string',
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'email' => 'required|email',
            'celular' => 'required|string',
            'colegio_departamental' => 'nullable|string',
            'departamento' => 'nullable|string',
            'provincia' => 'nullable|string',
            'distrito' => 'nullable|string',
            'direccion_actual' => 'nullable|string',
            'categoria_participante' => 'required|string',
            'modalidad_participante' => 'required|string',
            'codigo_pago' => 'nullable|string',
            'tipo_comprobante' => 'nullable|string',
            'foto_voucher' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto_voucher')) {
            $path = $request->file('foto_voucher')->store('vouchers', 'public');
            $validated['foto_voucher'] = $path;
        }

        Participant::create($validated);

        // Redirect back to the landing page or a success page
        return redirect()->route('inscripciones')->with('success', 'Inscripción realizada con éxito.');
    }
}
