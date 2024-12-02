<?php

namespace App\Http\Controllers;


use App\Models\Cliente; // Ou Pacient, se você renomeou o modelo
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function show($id)
    {
        // Busca o paciente pelo ID
        $pacient = Cliente::findOrFail($id);

        // Retorna a view com os detalhes do paciente
        return view('pacients.show', compact('pacient'));
    }

    public function index()
    {
        // Recupera todos os pacientes
        $patients = Cliente::all();

        return view('index.patient', compact('patients'));
    }

    public function create()
    {
        // Verifica se o usuário é 'role_professor' ou 'role_admin'
        if (true) {
            // Retorna a view se a validação passar
            return view('index.patient');
        }

        // Se a validação falhar, retorna um erro 403 ou redireciona para outra página
        abort(403, 'Você não tem permissão para acessar esta página.');
    }

    public function store(Request $request)
    {
        // Verifica se o usuário é 'role_professor' ou 'role_admin'
        if (Auth::user()->isAdmin() || Auth::user()->isProfessor()) {
            // Validação dos dados enviados
            $validatedData = $request->validate([
                'cliente_nome' => 'required|string|max:255',
                'cliente_cpf' => 'required|string|max:14',
                'cliente_email' => 'required|email|max:255',
                'cliente_telefone' => 'required|string|max:15',
                'cliente_st_confirma_dados' => 'required|boolean',
            ]);

            // Define cliente_st_cadastro como false
            $validatedData['cliente_st_cadastro'] = false;

            // Adiciona o ID do usuário autenticado
            $validatedData['cliente_usuario_id'] = Auth::user()->id;
            $validatedData['cliente_usuario_id_atualizado'] = Auth::user()->id;

            // Criação do cliente
            $cliente = Cliente::create($validatedData);

            // Retornar resposta
            return redirect()->route('index.patient')->with('success', 'Paciente cadastrado com sucesso!');
        }

        // Se a validação falhar, retorna um erro 403 ou redireciona para outra página
        abort(403, 'Você não tem permissão para acessar esta página.');
    }


    public function edit($id)
    {
        // Recupera o paciente pelo ID
        $patient = Cliente::findOrFail($id);

        return view('index.patient', compact('patient'));
    }

    public function update(Request $request, $id)
    {
        // Validação dos dados
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'gender' => 'required|string|max:15',
            'cpf' => 'required|string|max:14',
            'rg' => 'required|string|max:15',
            'date_birth' => 'required|date',
            'education' => 'required|string|max:50',
            'period' => 'required|string|max:20',
            'service' => 'required|string|max:20',
        ]);

        // Atualiza o paciente
        $patient = Cliente::findOrFail($id);
        $patient->update([
            'cliente_nome' => $validated['name'],
            'cliente_email' => $validated['email'],
            'cliente_telefone' => $validated['phone'],
            'cliente_genero' => $validated['gender'],
            'cliente_cpf' => $validated['cpf'],
            'cliente_rg' => $validated['rg'],
            'cliente_dt_nascimento' => $validated['date_birth'],
            'cliente_escolaridade' => $validated['education'],
            'cliente_periodo_preferencia' => $validated['period'],
            'cliente_tipo_atendimento' => $validated['service'],
            'cliente_st_confirma_dados' => true,
        ]);

        return redirect()->route('index.patient')->with('success', 'Paciente atualizado com sucesso!');
    }

    public function buscar(Request $request)
{
    $patients = Cliente::query()
        ->select([
            'clientes.*',
            'user.name as user_name',
            'user.email as user_email',
            'professor.name as professor_name',
        ])
        ->leftJoin('users as user', 'clientes.cliente_usuario_Id', '=', 'user.id')
        ->leftJoin('users as professor', 'user.User_professor_Id', '=', 'professor.id')
        ->when($request->filled('cliente_nome'), function ($query) use ($request) {
            $query->where('clientes.cliente_nome', 'like', '%' . $request->cliente_nome . '%');
        })
        ->when($request->filled('cliente_cpf'), function ($query) use ($request) {
            $query->where('clientes.cliente_cpf', $request->cliente_cpf);
        })
        ->when($request->filled('cliente_email'), function ($query) use ($request) {
            $query->where('clientes.cliente_email', $request->cliente_email);
        })
        ->when($request->filled('cliente_telefone'), function ($query) use ($request) {
            $query->where('clientes.cliente_telefone', 'like', '%' . $request->cliente_telefone . '%');
        })
        ->when($request->filled('cliente_st_confirma_dados'), function ($query) use ($request) {
            $query->where('clientes.cliente_st_confirma_dados', $request->cliente_st_confirma_dados);
        })
        ->get();

    // Retorna a view diretamente com os resultados da busca
    return view('index.medical-record', compact('patients'));
}

}


