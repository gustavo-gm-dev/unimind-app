<?php

namespace App\Http\Controllers;

use App\Models\Sessao;
use App\Models\Prontuario;
use App\Models\Cliente;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function start($idMedicalRecord)
    {
        // Busca o prontuário e carrega o cliente relacionado
        $medicalRecord = Prontuario::with('cliente')->findOrFail($idMedicalRecord);

        // O cliente associado ao prontuário
        $patient = $medicalRecord->cliente;

        // Retorna a view com o prontuário e o cliente
        return view('index.session', compact('patient', 'medicalRecord'));
    }

    public function save(Request $request, $medicalRecordId)
    {
        // Valida os dados enviados
        $validatedData = $request->validate([
            'sessao_tx_principal' => 'required|string|max:500',
            'sessao_tx_procedure' => 'nullable|string|max:500',
            'sessao_tx_forwarding' => 'nullable|string|max:500',
            'sessao_tx_observation' => 'nullable|string|max:500',
        ]);

        // Verifica o prontuário
        $medicalRecord = Prontuario::findOrFail($medicalRecordId);

        // Cria a nova sessão vinculada ao prontuário
        Sessao::create([
            'prontuario_id' => $medicalRecord->prontuario_id,
            'sessao_tx_principal' => $validatedData['sessao_tx_principal'],
            'sessao_tx_procedimento' => $validatedData['sessao_tx_procedure'],
            'sessao_tx_encaminhamento' => $validatedData['sessao_tx_forwarding'],
            'sessao_tx_observacao' => $validatedData['sessao_tx_observation'],
            'sessao_dt_inicio' => now(),
            'sessao_dt_fim' => now(),
            'sessao_st_presenca' => true,
            'sessao_st_confirmado' => false,
        ]);

        // Redireciona com mensagem de sucesso
        return redirect()->route('sessions.create', $medicalRecord->prontuario_id)
            ->with('success', 'Sessão salva com sucesso!');
    }
}