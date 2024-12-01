<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Sessao;
use Illuminate\Http\Request;

class SchedulingController extends Controller
{
    public function create($id)
    {
        $patient = Cliente::with('prontuario')->findOrFail($id);
        return view('scheduling.create', compact('patient'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'sessao_dt_inicio' => 'required|date|after:today',
            'sessao_periodo' => 'required|in:manha,tarde,noite',
            'sessao_tipo_atendimento' => 'required|in:PRESENCIAL,REMOTO',
        ]);
    
        $prontuario = Cliente::findOrFail($id)->prontuario;
    
        Sessao::create([
            'sessao_prontuario_id' => $prontuario->prontuario_id,
            'sessao_dt_inicio' => $request->sessao_dt_inicio,
            'sessao_dt_fim' => null,
            'sessao_tipo_atendimento' => $request->sessao_tipo_atendimento,
            'sessao_st_presenca' => false,
            'sessao_st_confirmado' => 'PENDENTE',
            'sessao_periodo' => $request->sessao_periodo, // Salva o período
        ]);
    
        return redirect()->route('index.patient')->with('success', 'Agendamento criado com sucesso!');
    }

    public function edit($id)
    {
        $patient = Cliente::with('prontuario.sessoes')->findOrFail($id);
        $session = $patient->prontuario->sessoes->last();

        return view('scheduling.edit', compact('patient', 'session'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'sessao_dt_inicio' => 'required|date|after:today',
            'sessao_periodo' => 'required|in:manha,tarde,noite',
            'sessao_tipo_atendimento' => 'required|in:PRESENCIAL,REMOTO',
        ]);
    
        $session = Sessao::findOrFail($id);
    
        $session->update([
            'sessao_dt_inicio' => $request->sessao_dt_inicio,
            'sessao_tipo_atendimento' => $request->sessao_tipo_atendimento,
            'sessao_st_confirmado' => 'PENDENTE',
            'sessao_periodo' => $request->sessao_periodo, // Atualiza o período
        ]);
    
        return redirect()->route('index.patient')->with('success', 'Agendamento atualizado com sucesso!');
    }
    
}
