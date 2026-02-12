<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Mail;
use App\Mail\ParticipantActivated;

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

    public function edit(Participant $participant)
    {
        return Inertia::render('Participants/Edit', [
            'participant' => $participant
        ]);
    }

    public function update(Request $request, Participant $participant)
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
            'ruc' => 'nullable|string',
            'razon_social' => 'nullable|string',
            'status' => 'required|integer',
        ]);

        $oldStatus = $participant->status;

        if ($request->hasFile('foto_voucher')) {
            $path = $request->file('foto_voucher')->store('vouchers', 'public');
            $validated['foto_voucher'] = $path;
        }

        $participant->update($validated);

        // Send email if activated
        if ($oldStatus == 0 && $participant->status == 1) {
            Mail::to($participant->email)->send(new ParticipantActivated($participant));
        }

        return redirect()->route('participants.index')->with('success', 'Participante actualizado.');
    }

    public function destroy(Participant $participant)
    {
        $participant->delete();
        return redirect()->route('participants.index')->with('success', 'Participante eliminado.');
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
            'ruc' => 'nullable|string',
            'razon_social' => 'nullable|string',
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
            'ruc' => 'nullable|string',
            'razon_social' => 'nullable|string',
            'foto_voucher' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto_voucher')) {
            $path = $request->file('foto_voucher')->store('vouchers', 'public');
            $validated['foto_voucher'] = $path;
        }

        Participant::create($validated);

        // Redirect back so the frontend can show the success modal
        return back()->with('success', 'Inscripción realizada con éxito.');
    }
}
