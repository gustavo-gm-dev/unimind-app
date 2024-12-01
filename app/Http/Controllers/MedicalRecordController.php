<?php

namespace App\Http\Controllers;

use App\Models\Prontuario;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class MedicalRecordController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Usuário autenticado

        // Filtra os clientes que estão vinculados ao aluno autenticado
        $patients = Cliente::accessibleByUser($user)->get();

        return view('index.medical-record', compact('patients'));
    }

    public function edit($id)
    {
        $user = Auth::user(); // Usuário autenticado
    
        // Recupera os pacientes acessíveis ao usuário
        $patient = Cliente::accessibleByUser($user)
            ->findOrFail($id);

        return view('index.medical-record', compact('patient'));
    }

    public function save(Request $request, $cliente_id)
    {
        $user = auth()->user(); // Usuário autenticado
    
        // Validação dos dados do prontuário
        $validated = $request->validate([
            'prontuario_tx_historico_familiar' => 'nullable|string',
            'prontuario_tx_historico_social' => 'nullable|string',
            'prontuario_tx_consideracoes' => 'nullable|string',
            'prontuario_tx_observacao' => 'nullable|string',
        ]);
        
        $validated['prontuario_st_validacao_prof'] = false;
        $validated['prontuario_usuario_id_atualizado'] = $user->id;
    
        // Verifica se o aluno ou professor tem acesso ao paciente
        $patient = Cliente::whereHas('vinculo', function ($query) use ($user) {
            if ($user->role === 'role_aluno') {
                $query->where('vinculo_aluno_id', $user->id);
            } elseif ($user->role === 'role_professor') {
                $query->whereHas('aluno', function ($subQuery) use ($user) {
                    $subQuery->where('professor_id', $user->id);
                });
            }
        })->findOrFail($cliente_id);
    
        // Atualiza ou cria o prontuário
        $medicalRecord = $patient->prontuario()->updateOrCreate(
            ['prontuario_cliente_id' => $patient->cliente_id], // Condição para verificar existência
            $validated // Dados para criação ou atualização
        );
    
        return redirect()->route('index.medical-record')->with('success', 'Prontuário salvo com sucesso!');
    }
    
    

    public function uploadFile(Request $request, $idPatient, $idRecord)
    {
        $user = auth()->user(); // Usuário autenticado

        // Validação dos campos do formulário
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048', // Apenas arquivos PDF, tamanho máximo de 2MB
            'arquivo_dt_realizada' => 'required|date', // Data obrigatória
        ]);

        // Verifica se o aluno tem acesso ao paciente
        $prontuario = Prontuario::where('prontuario_cliente_id', $idPatient)
            ->whereHas('cliente.vinculo', function ($query) use ($user) {
                $query->where('vinculo_aluno_id', $user->id);
            })
            ->where('prontuario_id', $idRecord)
            ->firstOrFail();

        // Criação do nome e caminho do arquivo
        $timestamp = now()->timestamp;
        $fileName = "PRONT_{$idRecord}_{$timestamp}.pdf";
        $directory = "public/files/patients/{$idPatient}";

        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory);
        }

        // Salva o arquivo no sistema
        $file = $request->file('file');
        Storage::put("{$directory}/{$fileName}", file_get_contents($file));

        // Criar um novo registro de arquivo diretamente relacionado ao prontuário
        Arquivo::create([
            'prontuario_id' => $prontuario->prontuario_id,
            'arquivo_url' => "files/patients/{$idPatient}/{$fileName}",
            'arquivo_dt_realizada' => $request->input('arquivo_dt_realizada'),
        ]);

        return redirect()->route('medical-records.edit', $idPatient)
            ->with('success', 'Arquivo carregado com sucesso!');
    }

    public function viewFile($idPatient, $idRecord, $fileId)
    {
        $user = auth()->user(); // Usuário autenticado

        try {
            // Verifica se o aluno tem acesso ao prontuário
            $prontuario = Prontuario::where('prontuario_cliente_id', $idPatient)
                ->where('prontuario_id', $idRecord)
                ->whereHas('cliente.vinculo', function ($query) use ($user) {
                    $query->where('vinculo_aluno_id', $user->id);
                })
                ->firstOrFail();

            // Busca o arquivo associado ao prontuário
            $arquivo = $prontuario->arquivos()->where('arquivo_id', $fileId)->firstOrFail();

            $filePath = "{$arquivo->arquivo_url}";

            if (!Storage::disk('public')->exists($filePath)) {
                return response()->json([
                    'message' => "Arquivo não encontrado. Caminho: {$filePath}",
                ], 404);
            }

            return Storage::disk('public')->download($filePath);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao processar a solicitação.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
