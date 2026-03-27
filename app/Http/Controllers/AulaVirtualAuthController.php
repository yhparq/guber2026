<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\CorporateParticipant;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;

class AulaVirtualAuthController extends Controller
{
    public function showLogin()
    {
        return Inertia::render('AulaVirtual/Login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'dni' => 'required|string',
        ]);

        // Search in Individual Participants
        $participant = Participant::where('email', $request->email)
            ->where('dni', $request->dni)
            ->first();
        
        $type = 'individual';

        // If not found, search in Corporate Participants
        if (!$participant) {
            $participant = CorporateParticipant::where('email', $request->email)
                ->where('dni', $request->dni)
                ->first();
            $type = 'corporate';
        }

        if (!$participant) {
            return back()->withErrors([
                'email' => 'Las credenciales no coinciden con nuestros registros.',
            ]);
        }

        if ($participant->status !== 1) {
            return back()->withErrors([
                'email' => 'Tu cuenta aún no ha sido activada. Por favor, espera el correo de confirmación.',
            ]);
        }

        // Store participant in session
        Session::put('participant_id', $participant->id);
        Session::put('participant_type', $type);

        return redirect()->route('aula-virtual.index');
    }

    public function logout()
    {
        Session::forget(['participant_id', 'participant_type']);
        return redirect()->route('aula-virtual.login');
    }
}
