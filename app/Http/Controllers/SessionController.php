<?php

namespace App\Http\Controllers;

use App\Models\Sessao;
use App\Models\Prontuario;
use App\Models\Cliente;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function create($prontuario_id)
    {
        // Busca o prontuário com o cliente relacionado
        $medicalRecord = Prontuario::with('cliente')->findOrFail($prontuario_id);
    
        // Valida se o prontuário possui um cliente associado
        if (!$medicalRecord->cliente) {
            return redirect()->back()->withErrors('O prontuário não possui um cliente associado.');
        }
    
        // Obtém o cliente relacionado
        $patient = $medicalRecord->cliente;
        
        // Determina o período com base no horário atual
        $hour = now()->format('H'); // Hora atual no formato 24h
        $sessao_periodo = match (true) {
            $hour >= 6 && $hour < 12 => 'manha',
            $hour >= 12 && $hour < 18 => 'tarde',
            $hour >= 18 || $hour < 6 => 'noite',
        };

        // Cria a sessão
        $session = Sessao::create([
            'sessao_prontuario_id' => $medicalRecord->prontuario_id,
            'sessao_dt_inicio' => now(),
            'sessao_periodo' => $sessao_periodo,
            'sessao_st_presenca' => true,
            'sessao_st_confirmado' => 'INICIADA', // Considere usar constantes ou enums
        ]);
    
        // Retorna a view com os dados do paciente e do prontuário
        return view('index.session', compact('patient', 'medicalRecord', 'session'));
    }

    public function update(Request $request, $sessao_id)
    {
        // Valida os dados enviados
        $validatedData = $request->validate([
            'sessao_tx_principal' => 'nullable|string|max:500',
            'sessao_tx_procedure' => 'nullable|string|max:500',
            'sessao_tx_forwarding' => 'nullable|string|max:500',
            'sessao_tx_observation' => 'nullable|string|max:500',
        ]);
    
        // Localiza a sessão pelo ID
        $session = Sessao::findOrFail($sessao_id);
        
        // Determina a ação (salvar ou finalizar)
        $action = $request->input('action');

        if ($action === 'save') {
            // Salva os dados e mantem status INICIADA
            $session->update([
                'sessao_tx_principal' => $validatedData['sessao_tx_principal'] ?? null,
                'sessao_tx_procedimento' => $validatedData['sessao_tx_procedure'] ?? null,
                'sessao_tx_encaminhamento' => $validatedData['sessao_tx_forwarding'] ?? null,
                'sessao_tx_observacao' => $validatedData['sessao_tx_observation'] ?? null,
                'sessao_st_presenca' => true,
                'sessao_st_confirmado' => 'INICIADA',
            ]);
        } elseif ($action === 'finalize') {
            // Atualiza os dados da sessão
            $session->update([
                'sessao_tx_principal' => $validatedData['sessao_tx_principal'] ?? null,
                'sessao_tx_procedimento' => $validatedData['sessao_tx_procedure'] ?? null,
                'sessao_tx_encaminhamento' => $validatedData['sessao_tx_forwarding'] ?? null,
                'sessao_tx_observacao' => $validatedData['sessao_tx_observation'] ?? null,
                'sessao_st_presenca' => true,
                'sessao_st_confirmado' => 'CONCLUIDA',
                'sessao_dt_fim' => now(),
            ]);
        }
        
        // Obtém o prontuário e o paciente relacionados
        $medicalRecord = Prontuario::findOrFail($session->sessao_prontuario_id);
        $patient = $medicalRecord->cliente;
    
        // Redireciona com mensagem de sucesso
        return redirect()->route('medical-records.edit', $patient->cliente_id)->with('success', 'Sessão salva com sucesso!');
    }

    public function edit($sessao_id)
    {
        //busca pela sessao
        $session = Sessao::findOrFail($sessao_id);

        $session->update([
            'sessao_st_presenca' => true,
            'sessao_st_confirmado' => 'INICIADA',
        ]);

        // Obtém o prontuário e o paciente relacionados
        $medicalRecord = Prontuario::findOrFail($session->sessao_prontuario_id);
        $patient = $medicalRecord->cliente;

        return view('index.session', compact('patient', 'medicalRecord', 'session'));
    }
}