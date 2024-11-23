<?php

namespace App\Http\Controllers;

use App\Models\Cliente; // Ou Pacient, se você renomeou o modelo
use Illuminate\Http\Request;

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
}