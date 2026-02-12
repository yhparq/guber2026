<?php

namespace App\Http\Controllers;

use App\Models\Ponencia;
use App\Models\Participant;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;

class AulaVirtualController extends Controller
{
    public function index()
    {
        $participantId = Session::get('participant_id');
        
        if (!$participantId) {
            return redirect()->route('aula-virtual.login');
        }

        $participant = Participant::find($participantId);
        
        if (!$participant) {
            Session::forget('participant_id');
            return redirect()->route('aula-virtual.login');
        }

        $ponencias = Ponencia::orderBy('dia')->orderBy('hora_inicio')->get();

        return Inertia::render('AulaVirtual/Index', [
            'participant' => $participant,
            'ponencias' => $ponencias,
        ]);
    }
}
