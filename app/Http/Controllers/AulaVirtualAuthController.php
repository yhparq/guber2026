<?php

namespace App\Http\Controllers;

use App\Models\Participant;
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

        $participant = Participant::where('email', $request->email)
            ->where('dni', $request->dni)
            ->first();

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

        return redirect()->route('aula-virtual.index');
    }

    public function logout()
    {
        Session::forget('participant_id');
        return redirect()->route('aula-virtual.login');
    }
}
