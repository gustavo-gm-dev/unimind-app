<?php

namespace App\Http\Controllers;

use App\Models\Prontuario;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MedicalRecordController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Usuário autenticado

        // Filtra os clientes que estão vinculados ao aluno autenticado
        $patients = Cliente::whereHas('vinculos', function ($query) use ($user) {
            $query->where('vinculo_aluno_id', $user->id);
        })->with('prontuario', 'prontuario.sessoes')->get();

        return view('index.medical-record', compact('patients'));
    }

    public function edit($id)
    {
        $user = auth()->user(); // Usuário autenticado

        // Busca o paciente apenas se o aluno tiver acesso
        $patient = Cliente::whereHas('vinculos', function ($query) use ($user) {
            $query->where('vinculo_aluno_id', $user->id);
        })->with('prontuario.ultimoArquivo')->findOrFail($id);

        // Busca o prontuário associado ao paciente
        $medicalRecord = $patient->prontuario;

        // Busca as sessões associadas ao prontuário, ou uma coleção vazia se o prontuário não existir
        $sessions = $medicalRecord ? $medicalRecord->sessoes : collect();

        return view('index.medical-record', compact('patient', 'medicalRecord', 'sessions'));
    }

    public function save(Request $request, $id = null)
    {
        $user = auth()->user(); // Usuário autenticado

        // Validação dos dados do prontuário
        $validated = $request->validate([
            'prontuario_tx_historico_familiar' => 'nullable|string',
            'prontuario_tx_historico_social' => 'nullable|string',
            'prontuario_tx_consideracoes' => 'nullable|string',
            'prontuario_tx_observacao' => 'nullable|string',
        ]);

        // Verifica se o aluno tem acesso ao paciente
        $patient = Cliente::whereHas('vinculos', function ($query) use ($user) {
            $query->where('vinculo_aluno_id', $user->id);
        })->findOrFail($id);

        // Atualiza ou cria o prontuário
        $medicalRecord = $patient->prontuario()->updateOrCreate([], $validated);

        return redirect()->route('index.medical-record')->with('success', 'Prontuário atualizado com sucesso!');
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
            ->whereHas('cliente.vinculos', function ($query) use ($user) {
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
                ->whereHas('cliente.vinculos', function ($query) use ($user) {
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
