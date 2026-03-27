<?php

namespace App\Http\Controllers;

use App\Models\Ponencia;
use App\Models\Participant;
use App\Models\CorporateParticipant;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;

class AulaVirtualController extends Controller
{
    public function index()
    {
        $participantId = Session::get('participant_id');
        $participantType = Session::get('participant_type');
        
        if (!$participantId) {
            return redirect()->route('aula-virtual.login');
        }

        // Fetch participant based on type
        if ($participantType === 'corporate') {
            $participant = CorporateParticipant::find($participantId);
        } else {
            $participant = Participant::find($participantId);
        }
        
        if (!$participant) {
            Session::forget(['participant_id', 'participant_type']);
            return redirect()->route('aula-virtual.login');
        }

        $ponencias = Ponencia::orderBy('dia')->orderBy('hora_inicio')->get();

        return Inertia::render('AulaVirtual/Index', [
            'participant' => $participant,
            'ponencias' => $ponencias,
        ]);
    }
}
