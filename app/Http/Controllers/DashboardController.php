<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Prontuario;
use App\Models\Sessao;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Contagem de pacientes, prontuários e sessões
        $totalPatients = Cliente::count();
        $totalMedicalRecords = Prontuario::count();
        $totalScheduledSessions = Sessao::count();
        $totalSessionsHeld = Sessao::where('sessao_st_confirmado', 'CONCLUIDA')->count();

        // Lista de sessões agendadas (hoje e futuras)
        $sessions = Sessao::with(['prontuario.cliente', 'prontuario.ultimoArquivo']) // Carrega os relacionamentos
            ->where('sessao_dt_inicio', '>=', now()->toDateString())
            ->orderBy('sessao_dt_inicio', 'asc')
            ->get()
            ->map(function ($session) {
                $prontuario = $session->prontuario;
                $cliente = $prontuario ? $prontuario->cliente : null;
                $ultimoArquivo = $prontuario ? $prontuario->ultimoArquivo : null;

                return (object)[
                    'id' => $session->sessao_id,
                    'prontuario_id' => $prontuario->prontuario_id,
                    'cliente_id' => $cliente->cliente_id,
                    'date' => $session->sessao_dt_inicio,
                    'situacao' => $session->sessao_st_confirmado,
                    'status' => $session->sessao_st_presenca ? 'Concluída' : 'Agendada',
                    'patient' => (object)[
                        'name' => $cliente ? $cliente->cliente_nome : 'Não informado'
                    ],
                    'ultimoArquivo' => $ultimoArquivo ? (object)[
                        'id' => $ultimoArquivo->arquivo_id,
                    ] : null
                ];
            });

            //dd($sessions);

        // Retornar os dados para a view
        return view('dashboard', compact(
            'totalPatients', 
            'totalMedicalRecords', 
            'totalScheduledSessions',
            'totalSessionsHeld',
            'sessions'
        ));
    }
}
