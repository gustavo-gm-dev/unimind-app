<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\Patient;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Lista todas as sessões.
     */
    public function index()
    {
        $sessions = Session::with('patient')->get(); // Carrega as sessões com os pacientes vinculados
        return view('sessions.index', compact('sessions'));
    }

    /**
     * Exibe os detalhes de uma sessão específica.
     */
    public function show($id)
    {
        $session = Session::with('patient')->findOrFail($id); // Carrega a sessão e o paciente
        return view('sessions.show', compact('session'));
    }

    /**
     * Exibe o formulário de criação de uma nova sessão.
     */
    public function create()
    {
        $patients = Patient::all(); // Lista todos os pacientes
        return view('sessions.create', compact('patients'));
    }

    /**
     * Salva uma nova sessão no banco de dados.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'date' => 'required|date',
            'status' => 'required|string|max:255',
        ]);

        Session::create($validated);

        return redirect()->route('sessions.index')->with('success', 'Sessão criada com sucesso!');
    }

    /**
     * Exibe o formulário de edição de uma sessão.
     */
    public function edit($id)
    {
        $session = Session::findOrFail($id);
        $patients = Patient::all(); // Lista todos os pacientes para selecionar
        return view('sessions.edit', compact('session', 'patients'));
    }

    /**
     * Atualiza os dados de uma sessão no banco de dados.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'date' => 'required|date',
            'status' => 'required|string|max:255',
        ]);

        $session = Session::findOrFail($id);
        $session->update($validated);

        return redirect()->route('sessions.index')->with('success', 'Sessão atualizada com sucesso!');
    }

    /**
     * Remove uma sessão do banco de dados.
     */
    public function destroy($id)
    {
        $session = Session::findOrFail($id);
        $session->delete();

        return redirect()->route('sessions.index')->with('success', 'Sessão excluída com sucesso!');
    }
}
