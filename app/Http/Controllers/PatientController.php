<?php

namespace App\Http\Controllers;


use App\Models\Cliente;
use App\Models\Vinculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Usuário autenticado

        // Recupera os pacientes vinculados ao aluno autenticado
        $patients = Cliente::whereHas('vinculo', function ($query) use ($user) {
            $query->where('vinculo_aluno_id', $user->id);
        })->with('prontuario')->get();

        return view('index.patient', compact('patients'));
    }

    public function show($id)
    {
        $user = Auth::user(); // Usuário autenticado

        // Busca o paciente pelo ID e garante que o aluno tem acesso
        $pacient = Cliente::whereHas('vinculo', function ($query) use ($user) {
            $query->where('vinculo_aluno_id', $user->id);
        })->with('prontuario')->findOrFail($id);

        return view('pacients.show', compact('pacient'));
    }

    public function edit($id)
    {
        $user = Auth::user(); // Usuário autenticado

        // Busca o paciente pelo ID e garante que o aluno tem acesso
        $patient = Cliente::whereHas('vinculo', function ($query) use ($user) {
            $query->where('vinculo_aluno_id', $user->id);
        })->findOrFail($id);

        return view('index.patient', compact('patient'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
    
        // Valida se o paciente está vinculado ao aluno
        $patient = Cliente::whereHas('vinculo', function ($query) use ($user) {
            $query->where('vinculo_aluno_id', $user->id);
        })->findOrFail($id);
    
        $validatedData = $request->validate([
            // Validação dos dados do cliente
            'cliente_nome' => 'required|string|max:255',
            'cliente_cpf' => 'nullable|string|max:14',
            'cliente_rg' => 'nullable|string|max:15',
            'cliente_email' => 'required|email|max:255',
            'cliente_telefone' => 'required|string|max:15',
            'cliente_dt_nascimento' => 'nullable|date',
            'cliente_genero' => 'nullable|string|max:15',
            'cliente_escolaridade' => 'nullable|string|max:50',
            'cliente_periodo_preferencia' => 'nullable|string|max:20',
            'cliente_tipo_atendimento' => 'nullable|string|max:20',
            // Validação dos dados do endereço
            'endereco_logradouro' => 'nullable|string|max:255',
            'endereco_numero' => 'nullable|string|max:50',
            'endereco_complemento' => 'nullable|string|max:255',
            'endereco_bairro' => 'nullable|string|max:255',
            'endereco_cidade' => 'nullable|string|max:255',
            'endereco_uf' => 'nullable|string|max:2',
            'endereco_cep' => 'nullable|string|max:15',
        ]);
    
        if (empty($validatedData['cliente_cpf']) && empty($validatedData['cliente_rg'])) {
            return redirect()->back()
                ->withErrors(['cpf_rg' => 'Pelo menos o CPF ou RG devem ser preenchidos.'])
                ->withInput();
        }
    
        $validatedData['cliente_usuario_id_atualizado'] = $user->id;
    
        // Atualiza o cliente
        $patient->update($validatedData);
    
        // Atualiza ou cria o endereço
        $patient->endereco()->updateOrCreate(
            ['endereco_cliente_id' => $patient->cliente_id],
            [
                'endereco_logradouro' => $validatedData['endereco_logradouro'],
                'endereco_numero' => $validatedData['endereco_numero'],
                'endereco_complemento' => $validatedData['endereco_complemento'],
                'endereco_bairro' => $validatedData['endereco_bairro'],
                'endereco_cidade' => $validatedData['endereco_cidade'],
                'endereco_uf' => $validatedData['endereco_uf'],
                'endereco_cep' => $validatedData['endereco_cep'],
            ]
        );
    
        // Atualiza o status de cadastro completo
        $patient->update(['cliente_st_cadastro' => $patient->isCadastroCompleto()]);
    
        return redirect()->route('index.patient')->with('success', 'Paciente atualizado com sucesso!');
    }
    

    public function store(Request $request)
    {
        $user = Auth::user(); // Usuário autenticado

        $validatedData = $request->validate([
            // Validação dos dados do cliente
            'cliente_nome' => 'required|string|max:255',
            'cliente_cpf' => 'nullable|string|max:14',
            'cliente_rg' => 'nullable|string|max:15',
            'cliente_email' => 'required|email|max:255',
            'cliente_telefone' => 'required|string|max:15',
            'cliente_dt_nascimento' => 'nullable|date',
            'cliente_genero' => 'nullable|string|max:15',
            'cliente_escolaridade' => 'nullable|string|max:50',
            'cliente_periodo_preferencia' => 'nullable|string|max:20',
            'cliente_tipo_atendimento' => 'nullable|string|max:20',
            'cliente_st_confirma_dados' => 'nullable|boolean',
            // Validação dos dados do endereço
            'endereco_logradouro' => 'nullable|string|max:255',
            'endereco_numero' => 'nullable|string|max:50',
            'endereco_complemento' => 'nullable|string|max:255',
            'endereco_bairro' => 'nullable|string|max:255',
            'endereco_cidade' => 'nullable|string|max:255',
            'endereco_uf' => 'nullable|string|max:2',
            'endereco_cep' => 'nullable|string|max:15',
        ]);

        if (empty($validatedData['cliente_cpf']) && empty($validatedData['cliente_rg'])) {
            return redirect()->back()
                ->withErrors(['cpf_rg' => 'Pelo menos o CPF ou RG devem ser preenchidos.'])
                ->withInput();
        }

        $validatedData['cliente_usuario_id'] = $user->id;
        $validatedData['cliente_usuario_id_atualizado'] = $user->id;

        // Cria o cliente
        $cliente = Cliente::create($validatedData);

        // Cria o endereço relacionado
        $cliente->endereco()->create([
            'endereco_cliente_id' => $cliente->cliente_id,
            'endereco_logradouro' => $validatedData['endereco_logradouro'],
            'endereco_numero' => $validatedData['endereco_numero'],
            'endereco_complemento' => $validatedData['endereco_complemento'],
            'endereco_bairro' => $validatedData['endereco_bairro'],
            'endereco_cidade' => $validatedData['endereco_cidade'],
            'endereco_uf' => $validatedData['endereco_uf'],
            'endereco_cep' => $validatedData['endereco_cep'],
        ]);

        // Atualiza o status de cadastro completo
        $cliente->update(['cliente_st_cadastro' => $cliente->isCadastroCompleto()]);

        Vinculo::create([
            'vinculo_aluno_id' => $user->id,
            'vinculo_cliente_id' => $cliente->cliente_id,
        ]);

        return redirect()->route('index.patient')->with('success', 'Paciente cadastrado com sucesso!');
    }


    public function create()
    {
        // Retorna a view se a validação passar
        return view('index.patient');

    }
    

    

}