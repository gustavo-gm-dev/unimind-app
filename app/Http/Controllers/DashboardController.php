<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Prontuario;
use App\Models\Sessao;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        // $sessions = Sessao::with(['prontuario.cliente', 'prontuario.ultimoArquivo']) // Carrega os relacionamentos
        //     ->where('sessao_dt_inicio', '>=', now()->toDateString())
        //     ->orderBy('sessao_dt_inicio', 'asc')
        //     ->get()
        //     ->map(function ($session) {
        //         $prontuario = $session->prontuario;
        //         $cliente = $prontuario ? $prontuario->cliente : null;
        //         $ultimoArquivo = $prontuario ? $prontuario->ultimoArquivo : null;

        //         return (object)[
        //             'id' => $session->sessao_id,
        //             'prontuario_id' => $prontuario->prontuario_id,
        //             'cliente_id' => $cliente->cliente_id,
        //             'date' => $session->sessao_dt_inicio,
        //             'situacao' => $session->sessao_st_confirmado,
        //             'status' => $session->sessao_st_presenca ? 'Concluída' : 'Agendada',
        //             'patient' => (object)[
        //                 'name' => $cliente ? $cliente->cliente_nome : 'Não informado'
        //             ],
        //             'ultimoArquivo' => $ultimoArquivo ? (object)[
        //                 'id' => $ultimoArquivo->arquivo_id,
        //             ] : null
        //         ];
        //     });


$sessions = DB::table('sessoes')
    ->join('prontuarios', 'sessoes.sessao_prontuario_id', '=', 'prontuarios.prontuario_id')
    ->leftJoin('clientes', 'prontuarios.prontuario_cliente_id', '=', 'clientes.cliente_id')
    ->leftJoin('arquivos as ultimo_arquivo', 'prontuarios.prontuario_id', '=', 'ultimo_arquivo.arquivo_prontuario_id')
    ->where('sessoes.sessao_dt_inicio', '>=', now()->toDateString())
    ->orderBy('sessoes.sessao_dt_inicio', 'asc')
    ->get([
        'sessoes.sessao_id',
        'sessoes.sessao_dt_inicio',
        'sessoes.sessao_st_confirmado',
        'sessoes.sessao_st_presenca',
        'prontuarios.prontuario_id',
        'clientes.cliente_id',
        'clientes.cliente_nome',
        'arquivo_prontuario_id'
    ])
    ->map(function ($sessions) {

        $prontuarios = $sessions->prontuario_id;
        $ultimoArquivo = $prontuarios ? $sessions->arquivo_prontuario_id : null;

        return (object)[
            'id' => $sessions->sessao_id,
            'prontuario_id' => $sessions->prontuario_id,
            'cliente_id' => $sessions->cliente_id,
            'date' => $sessions->sessao_dt_inicio,
            'situacao' => $sessions->sessao_st_confirmado,
            'status' => $sessions->sessao_st_presenca ? 'Concluída' : 'Agendada',
            'patient' => (object)[
                'name' => $sessions->cliente_nome ?? 'Não informado'
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
