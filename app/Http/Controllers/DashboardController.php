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
        $user = auth()->user(); // Usuário autenticado

        // Filtra os clientes vinculados ao aluno autenticado
        $clientes = Cliente::byAluno($user)->get();

        // Obtém todos os prontuários relacionados aos clientes
        $prontuarios = $clientes->flatMap(function ($cliente) {
            return $cliente->prontuario ? [$cliente->prontuario] : [];
        });

        // Obtém todas as sessões relacionadas aos prontuários
        $sessoes = $prontuarios->flatMap(function ($prontuario) {
            return $prontuario->sessoes;
        });

        // Contagens
        $totalPatients = $clientes->count();
        $totalMedicalRecords = $prontuarios->count();
        $totalScheduledSessions = $sessoes->count();
        $totalSessionsHeld = $sessoes->where('sessao_st_confirmado', 'CONCLUIDA')->count();

        // Lista de sessões agendadas (hoje e futuras)
        $futureSessions = $sessoes->filter(function ($sessao) {
            return $sessao->sessao_dt_inicio >= now()->toDateString();
        })->sortBy('sessao_dt_inicio')->map(function ($session) {
            $prontuario = $session->prontuario;
            $cliente = $prontuario ? $prontuario->cliente : null;
            $ultimoArquivo = $prontuario ? $prontuario->ultimoArquivo : null;

            return (object)[
                'id' => $session->sessao_id,
                'prontuario_id' => $prontuario->prontuario_id ?? null,
                'cliente_id' => $cliente->cliente_id ?? null,
                'date' => $session->sessao_dt_inicio,
                'situacao' => $session->sessao_st_confirmado,
                'status' => $session->sessao_st_presenca ? 'Concluída' : 'Agendada',
                'patient' => (object)[
                    'name' => $cliente->cliente_nome ?? 'Não informado',
                ],
                'ultimoArquivo' => $ultimoArquivo ? (object)[
                    'id' => $ultimoArquivo->arquivo_id,
                ] : null,
            ];
        });

        // Retornar os dados para a view
        return view('dashboard', compact(
            'totalPatients',
            'totalMedicalRecords',
            'totalScheduledSessions',
            'totalSessionsHeld',
            'futureSessions'
        ));
    }
}
