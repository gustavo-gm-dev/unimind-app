<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Prontuario;
use App\Models\Sessao;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Contagem de pacientes, prontuários e sessões
        $totalPatients = Cliente::count();
        $totalMedicalRecords = Prontuario::count();
        $totalScheduledSessions = Sessao::where('sessao_st_confirmado', true)->count();

        // Lista de pacientes vinculados
        $patients = Cliente::with('prontuario')->get()->map(function ($patient) {
            return (object)[
                'id' => $patient->cliente_id,
                'name' => $patient->cliente_nome,
                'age' => \Carbon\Carbon::parse($patient->cliente_dt_nascimento)->age,
                'diagnosis' => $patient->prontuario->prontuario_tx_historico_social ?? 'Não informado'
            ];
        });

        // Lista de sessões agendadas
        $sessions = Sessao::with('prontuario.cliente')->get()->map(function ($session) {
            return (object)[
                'id' => $session->sessao_id,
                'date' => $session->sessao_dt_inicio,
                'status' => $session->sessao_st_presenca ? 'Concluída' : 'Agendada',
                'patient' => (object)[
                    'name' => $session->prontuario->cliente->cliente_nome ?? 'Não informado'
                ]
            ];
        });

        // Retornar os dados para a view
        return view('dashboard', compact(
            'totalPatients', 
            'totalMedicalRecords', 
            'totalScheduledSessions', 
            'patients', 
            'sessions'
        ));
    }

}
