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

        // Verifica se o usuário é 'role_professor' ou 'role_admin'
        if (Auth::check() && (Auth::user()->role === 'role_professor' || Auth::user()->role === 'role_admin')) {
            // Retorna a view se a validação passar
            return view('index.setting', compact('patients','students','vinculos'));
        }
    
        // Se a validação falhar, retorna um erro 403 ou redireciona para outra página
        abort(403, 'Você não tem permissão para acessar esta página.');
    }

    public function find(Request $request)
    {   
        $patients = Cliente::query()
            ->when($request->input('cliente_busca'), function ($query, $clienteBusca) {
                $query->where('cliente_nome', 'like', "%$clienteBusca%")
                    ->orWhere('cliente_cpf', $clienteBusca);
            })
            ->get();

        $students = User::query()
            ->where('role', User::ROLE_ALUNO)
            ->get();

        $vinculos = Vinculo::where('vinculo_data_inicio', '<=', now()->toDateString())
            ->where('vinculo_data_fim', '>=', now()->toDateString())
            ->get();
            
        // Verifica se o usuário é 'role_professor' ou 'role_admin'
        if (Auth::check() && (Auth::user()->role === 'role_professor' || Auth::user()->role === 'role_admin')) {
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