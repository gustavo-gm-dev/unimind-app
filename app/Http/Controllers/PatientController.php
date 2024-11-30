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
        $patients = Cliente::whereHas('vinculos', function ($query) use ($user) {
            $query->where('vinculo_aluno_id', $user->id);
        })->with('prontuario')->get();

        return view('index.patient', compact('patients'));
    }

    public function show($id)
    {
        $user = Auth::user(); // Usuário autenticado

        // Busca o paciente pelo ID e garante que o aluno tem acesso
        $pacient = Cliente::whereHas('vinculos', function ($query) use ($user) {
            $query->where('vinculo_aluno_id', $user->id);
        })->with('prontuario')->findOrFail($id);

        return view('pacients.show', compact('pacient'));
    }

    public function edit($id)
    {
        $user = Auth::user(); // Usuário autenticado

        // Busca o paciente pelo ID e garante que o aluno tem acesso
        $patient = Cliente::whereHas('vinculos', function ($query) use ($user) {
            $query->where('vinculo_aluno_id', $user->id);
        })->findOrFail($id);

        return view('index.patient', compact('patient'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user(); // Usuário autenticado

        // Valida se o paciente está vinculado ao aluno
        $patient = Cliente::whereHas('vinculos', function ($query) use ($user) {
            $query->where('vinculo_aluno_id', $user->id);
        })->findOrFail($id);

        // Validação dos dados
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'gender' => 'required|string|max:15',
            'cpf' => 'required|string|max:14',
            'date_birth' => 'required|date',
            'education' => 'required|string|max:50',
            'period' => 'required|string|max:20',
            'service' => 'required|string|max:20',
        ]);

        // Atualiza o paciente
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

    public function store(Request $request)
    {
        $user = Auth::user(); // Usuário autenticado

        $validatedData = $request->validate([
            // Dados do cliente
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
            // Dados do endereço
            'endereco_logradouro' => 'nullable|string|max:255',
            'endereco_numero' => 'nullable|string|max:50',
            'endereco_complemento' => 'nullable|string|max:255',
            'endereco_bairro' => 'nullable|string|max:255',
            'endereco_cidade' => 'nullable|string|max:255',
            'endereco_uf' => 'nullable|string|max:2',
            'endereco_cep' => 'nullable|string|max:15',
            'endereco_pais' => 'nullable|string|max:255',
        ]);

        if (empty($validatedData['cliente_cpf']) && empty($validatedData['cliente_rg'])) {
            return redirect()->back()
                ->withErrors(['cpf_rg' => 'Pelo menos o CPF ou RG devem ser preenchidos.'])
                ->withInput();
        }

        $validatedData['cliente_usuario_id'] = $user->id;
        $validatedData['cliente_usuario_id_atualizado'] = $user->id;

        $cliente = Cliente::create($validatedData);

        // Criar o endereço relacionado ao cliente
        $cliente->endereco()->create([
            'endereco_cliente_id' => $cliente->cliente_id,
            'endereco_logradouro' => $validatedData['endereco_logradouro'],
            'endereco_numero' => $validatedData['endereco_numero'],
            'endereco_complemento' => $validatedData['endereco_complemento'],
            'endereco_bairro' => $validatedData['endereco_bairro'],
            'endereco_cidade' => $validatedData['endereco_cidade'],
            'endereco_uf' => $validatedData['endereco_uf'],
            'endereco_cep' => $validatedData['endereco_cep'],
            'endereco_pais' => $validatedData['endereco_pais'],
        ]);

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
    
    /**
     * Verifica se todos os dados obrigatórios estão preenchidos para marcar o cadastro como completo.
     *
     * @param array $data
     * @return bool
     */
    private function isCadastroCompleto(array $data): bool
    {
        $requiredFields = [
            'cliente_nome',
            'cliente_email',
            'cliente_telefone',
            'cliente_dt_nascimento',
            'cliente_genero',
            'cliente_escolaridade',
            'cliente_periodo_preferencia',
            'cliente_tipo_atendimento'
        ];

        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                return false;
            }
        }

        return true;
    }
}