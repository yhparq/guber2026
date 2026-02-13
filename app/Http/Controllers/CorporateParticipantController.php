<?php

namespace App\Http\Controllers;

use App\Models\CorporateParticipant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Exports\CorporateParticipantsExport;
use Maatwebsite\Excel\Facades\Excel;

class CorporateParticipantController extends Controller
{
    public function index()
    {
        return Inertia::render('CorporateParticipants/Index', [
            'participants' => CorporateParticipant::latest()->paginate(50),
        ]);
    }

    public function exportExcel()
    {
        return Excel::download(new CorporateParticipantsExport, 'participantes_corporativos_' . date('Y-m-d') . '.xlsx');
    }

    public function create()
    {
        return Inertia::render('CorporateParticipants/Create');
    }

    public function edit(CorporateParticipant $corporateParticipant)
    {
        return Inertia::render('CorporateParticipants/Edit', [
            'participant' => $corporateParticipant
        ]);
    }

    public function update(Request $request, CorporateParticipant $corporateParticipant)
    {
        // Validation similar to store but for a single record
        $validated = $request->validate([
            'razon_social' => 'required|string',
            'codigo_pago' => 'required|string',
            'tipo_comprobante_pago' => 'nullable|string',
            
            'dni' => 'required|string',
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'email' => 'required|email',
            'celular' => 'required|string',
            
            'departamento' => 'nullable|string',
            'provincia' => 'nullable|string',
            'distrito' => 'nullable|string',
            'direccion' => 'required|string',
            
            'colegio_departamental' => 'nullable|string',
            'categoria_participante' => 'required|string',
            'modalidad_participante' => 'required|string',
            
            'tipo_comprobante_individual' => 'nullable|string',
            'ruc_individual' => 'nullable|string',
            
            'status' => 'required|integer',
        ]);

        if ($request->hasFile('foto_voucher')) {
            $path = $request->file('foto_voucher')->store('vouchers', 'public');
            $validated['foto_voucher'] = $path;
        }

        $corporateParticipant->update($validated);

        return redirect()->route('corporate-participants.index')->with('success', 'Participante corporativo actualizado.');
    }

    public function destroy(CorporateParticipant $corporateParticipant)
    {
        $corporateParticipant->delete();
        return redirect()->route('corporate-participants.index')->with('success', 'Participante corporativo eliminado.');
    }

    public function createPublic()
    {
        return Inertia::render('CorporateParticipants/PublicCreate');
    }

    public function storePublic(Request $request)
    {
        $request->validate([
            'razon_social' => 'required|string',
            'codigo_pago' => 'required|string',
            'tipo_comprobante' => 'nullable|string',
            'foto_voucher' => 'required|image|max:2048',
            'participants' => 'required|array|min:5',
            'participants.*.dni' => 'required|string',
            'participants.*.nombres' => 'required|string',
            'participants.*.apellidos' => 'required|string',
            'participants.*.email' => 'required|email',
            'participants.*.celular' => 'required|string',
            'participants.*.departamento' => 'nullable|string',
            'participants.*.provincia' => 'nullable|string',
            'participants.*.distrito' => 'nullable|string',
            'participants.*.direccion' => 'required|string',
            'participants.*.colegio_departamental' => 'nullable|string',
            'participants.*.categoria' => 'required|string',
            'participants.*.modalidad' => 'required|string',
            'participants.*.tipo_comprobante' => 'nullable|string',
            'participants.*.ruc' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $voucherPath = null;
            if ($request->hasFile('foto_voucher')) {
                $voucherPath = $request->file('foto_voucher')->store('vouchers', 'public');
            }

            foreach ($request->participants as $p) {
                CorporateParticipant::create([
                    // --- Group / Payment Info (Repeated) ---
                    'razon_social' => $request->razon_social,
                    'codigo_pago' => $request->codigo_pago,
                    'tipo_comprobante_pago' => $request->tipo_comprobante, // Global receipt type (Factura/Boleta for the payment)
                    'foto_voucher' => $voucherPath,
                    
                    // --- Personal Info ---
                    'dni' => $p['dni'],
                    'nombres' => $p['nombres'],
                    'apellidos' => $p['apellidos'],
                    'email' => $p['email'],
                    'celular' => $p['celular'],
                    
                    'departamento' => $p['departamento'],
                    'provincia' => $p['provincia'],
                    'distrito' => $p['distrito'],
                    'direccion' => $p['direccion'],
                    
                    'colegio_departamental' => $p['colegio_departamental'],
                    'categoria_participante' => $p['categoria'],
                    'modalidad_participante' => $p['modalidad'],
                    
                    // --- Individual Invoice Info ---
                    'tipo_comprobante_individual' => $p['tipo_comprobante'] ?? null,
                    'ruc_individual' => $p['ruc'] ?? null,
                    
                    'status' => 0, // Pending
                ]);
            }

            DB::commit();

            return back()->with('success', 'Inscripción corporativa enviada con éxito. Pendiente de verificación.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Ocurrió un error al procesar la inscripción: ' . $e->getMessage()]);
        }
    }
}