<?php

namespace App\Http\Controllers;

use App\Models\Vinculo;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index()
    {

        $patients = Cliente::all();
        $students = User::query()
            ->where('role', User::ROLE_ALUNO)
            ->get();
        $vinculos = Vinculo::where('vinculo_data_inicio', '<=', now()->toDateString())
            ->where('vinculo_data_fim', '>=', now()->toDateString())
            ->get();
        // aqui tira validacao do pefil vava
        // Verifica se o usuário é 'role_professor' ou 'role_admin'
        if (true) {
            // Retorna a view se a validação passar
            return view('index.setting', compact('patients','students','vinculos'));
        }

        // Se a validação falhar, retorna um erro 403 ou redireciona para outra página
        abort(403, 'Você não tem permissão para acessar esta página.');
    }

    public function find(Request $request)
    {
        $clienteBusca = $request->input('cliente_busca');
        $alunoBusca = $request->input('aluno_busca');
        $ProfBusca = $request->input('prof_busca');

        $patients = Cliente::query()
        ->leftJoin('users as user', 'clientes.cliente_usuario_Id', '=', 'user.id') // Join com a tabela de usuários
        ->leftJoin('users as professor', 'user.User_professor_Id', '=', 'professor.id') // Join com 'users' como professor
        ->when($clienteBusca, function ($query, $clienteBusca) {
            // Filtro para busca por cliente
            $query->where('clientes.cliente_nome', 'like', "%$clienteBusca%")
                    ->orWhere('clientes.cliente_cpf', 'like', "%$clienteBusca%");
        })
        ->when($alunoBusca, function ($query, $alunoBusca) {
            // Filtro para busca por aluno
            $query->where('user.name', 'like', "%$alunoBusca%")
                    ->orWhere('user.name', 'like', "%$alunoBusca%");
        })
        ->when($ProfBusca, function ($query, $ProfBusca) {
            // Filtro para busca por aluno
            $query->where('professor.name', 'like', "%$ProfBusca%")
                    ->orWhere('professor.name', 'like', "%$ProfBusca%");
        })
        ->when(
            !empty($ProfBusca) && !empty($alunoBusca) && !empty($clienteBusca),
            function ($query) use ($ProfBusca, $alunoBusca, $clienteBusca) {
                // Adicione os joins antes dos filtros, se necessário
                $query->where('professor.name', 'like', "%$ProfBusca%")
                      ->where('user.name', 'like', "%$alunoBusca%")
                      ->where('clientes.cliente_nome', 'like', "%$clienteBusca%");
            }
        )

        ->select(
            'clientes.*',
            'user.name as user_nome', // Nome do usuário da tabela 'users'
            'professor.name as professor_nome' // Nome do professor da tabela 'users'
        )

    // Obter os resultados da consulta
    ->get();



        $students = User::query()
            ->where('role', User::ROLE_ALUNO)
            ->get();

        $vinculos = Vinculo::where('vinculo_data_inicio', '<=', now()->toDateString())
            ->where('vinculo_data_fim', '>=', now()->toDateString())
            ->get();
        // aqui tira validacao do pefil vava
        // Verifica se o usuário é 'role_professor' ou 'role_admin'
        if (true) {
            // Retorna a view se a validação passar
            return view('index.setting', compact('patients','students','vinculos'));
        }

        // Se a validação falhar, retorna um erro 403 ou redireciona para outra página
        abort(403, 'Você não tem permissão para acessar esta página.');
    }

    public function store(Request $request)
    {
        // Captura os dados enviados
        $alunos = $request->input('aluno', []); // Array no formato [cliente_id => aluno_id]
        $datasInicio = $request->input('data_inicio', []); // Array no formato [cliente_id => data_inicio]
        $datasFim = $request->input('data_fim', []); // Array no formato [cliente_id => data_fim]

        foreach ($alunos as $clienteId => $alunoId) {
            // Recupera as datas correspondentes
            $dataInicio = $datasInicio[$clienteId] ?? null;
            $dataFim = $datasFim[$clienteId] ?? null;

            // Ignorar se algum dado essencial estiver faltando
            if (!$alunoId || !$dataInicio || !$dataFim) {
                continue;
            }

            // Cria ou atualiza o vínculo
            Vinculo::updateOrCreate(
                [
                    'vinculo_cliente_id' => $clienteId,
                    'vinculo_aluno_id' => $alunoId,
                ],
                [
                    'vinculo_usuario_id' => auth()->id(),
                    'vinculo_data_inicio' => $dataInicio,
                    'vinculo_data_fim' => $dataFim,
                ]
            );
        }

        return redirect()->route('setting.index')->with('success', 'Vínculos salvos com sucesso!');
    }

}
