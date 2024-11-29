<?php

namespace App\Http\Controllers;


use App\Models\Cliente;
use App\Models\Vinculo;
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
        // Retorna a view se a validação passar
        return view('index.patient');

    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
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
        ]);

        // Verifica se pelo menos CPF ou RG está preenchido
        if (empty($validatedData['cliente_cpf']) && empty($validatedData['cliente_rg'])) {
            return redirect()->back()
                ->withErrors(['cpf_rg' => 'Pelo menos o CPF ou RG devem ser preenchidos.'])
                ->withInput(); // Retorna os dados preenchidos anteriormente ao formulário
        }

        // Verificar duplicidade de cliente
        $existingCliente = Cliente::where(function ($query) use ($validatedData) {
            $query->where('cliente_cpf', $validatedData['cliente_cpf'])
                ->orWhere('cliente_rg', $validatedData['cliente_rg'])
                ->orWhere('cliente_email', $validatedData['cliente_email'])
                ->orWhere('cliente_telefone', $validatedData['cliente_telefone']);
        })->first();

        if ($existingCliente) {
            return redirect()->back()
                ->withErrors([
                    'cliente_duplicado' => 'Já existe um cliente com esses dados. Entre em contato com o professor responsável para mais informações.',
                ])
                ->withInput();
        }

        // Define cliente_st_cadastro com base na verificação de todos os campos
        $validatedData['cliente_st_cadastro'] = $this->isCadastroCompleto($validatedData);

        // Adiciona o ID do usuário autenticado
        $validatedData['cliente_usuario_id'] = Auth::user()->id;
        $validatedData['cliente_usuario_id_atualizado'] = Auth::user()->id;
    
        // Criação do cliente
        $cliente = Cliente::create($validatedData);

        // Criar vínculo entre cliente e usuário
        Vinculo::create([
            'vinculo_aluno_id' => Auth::user()->id,
            'vinculo_cliente_id' => $cliente->cliente_id,
        ]);
    
        // Retornar resposta
        return redirect()->route('index.patient')->with('success', 'Paciente cadastrado com sucesso!');
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
}