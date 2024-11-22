<?php

namespace App\Http\Controllers;

use App\Models\Prontuario;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class MedicalRecordController extends Controller 
{
    public function index()
    {
        // Busca todos os pacientes com seus prontuários e sessões
        $patients = Cliente::with('prontuario', 'prontuario.sessoes')->get();

        return view('index.medical-record', compact('patients'));
    }

    public function edit($id)
    {
        // Busca o paciente e garante o relacionamento com o prontuário
        $patient = Cliente::with('prontuario.ultimoArquivo')->findOrFail($id);
    
        // Busca o prontuário associado ao paciente
        $medicalRecord = $patient->prontuario;
    
        // Busca as sessões associadas ao prontuário, ou uma coleção vazia se o prontuário não existir
        $sessions = $medicalRecord ? $medicalRecord->sessoes : collect();
    
        // Retorna os dados para a view
        return view('index.medical-record', compact('patient', 'medicalRecord', 'sessions'));
    }
    

    public function save(Request $request, $id = null)
    {
        // Validação dos dados do prontuário
        $validated = $request->validate([
            'prontuario_tx_historico_familiar' => 'nullable|string',
            'prontuario_tx_historico_social' => 'nullable|string',
            'prontuario_tx_consideracoes' => 'nullable|string',
            'prontuario_tx_observacao' => 'nullable|string',
        ]);

        $patient = Cliente::findOrFail($id);

        // Atualiza ou cria o prontuário
        $medicalRecord = $patient->prontuario()->updateOrCreate([], $validated);

        return redirect()->route('medical_records.list')->with('success', 'Prontuário atualizado com sucesso!');
    }

    public function uploadFile(Request $request, $idPatient, $idRecord)
    {
        // Validação dos campos do formulário
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048', // Apenas arquivos PDF, tamanho máximo de 2MB
            'arquivo_dt_realizada' => 'required|date', // Data obrigatória
        ]);

        // Busca o prontuário do paciente
        $prontuario = Prontuario::where('prontuario_cliente_id', $idPatient)
            ->where('prontuario_id', $idRecord)
            ->firstOrFail();

        // Criação do nome e caminho do arquivo
        $timestamp = now()->timestamp;
        $fileName = "PRONT_{$idRecord}_{$timestamp}.pdf";
        $directory = "public/files/patients/{$idPatient}";

        // Verifica se o diretório existe e o cria, caso contrário
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

        // Redireciona com mensagem de sucesso
        return redirect()->route('medical-records.edit', $idPatient)
            ->with('success', 'Arquivo carregado com sucesso!');
    }

    public function viewFile($idPatient, $idRecord, $fileId)
    {
        try {
            // Busca o prontuário do paciente
            $prontuario = Prontuario::where('prontuario_cliente_id', $idPatient)
                ->where('prontuario_id', $idRecord)
                ->firstOrFail();
    
            // Busca o arquivo associado ao prontuário
            $arquivo = $prontuario->arquivos()->where('arquivo_id', $fileId)->firstOrFail();
    
            // Caminho relativo ao storage disk 'public'
            $filePath = "{$arquivo->arquivo_url}";
    
            // Verifica se o arquivo existe
            if (!Storage::disk('public')->exists($filePath)) {
                return response()->json([
                    'message' => "Arquivo não encontrado. Caminho: {$filePath}",
                ], 404);
            }
    
            // Retorna o arquivo para download
            return Storage::disk('public')->download($filePath);
    
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao processar a solicitação.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}