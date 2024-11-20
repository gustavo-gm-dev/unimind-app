<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\Patient;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Inicia uma sessão.
     */
    public function start($id)
    {
        $patient = (object)[
            'id' => $id,
            'name' => 'João da Silva',
            'email' => 'joao.silva@example.com',
            'cpf' => '123.456.789-10',
            'rg' => '12.345.678-9',
            'phone' => '(11) 98765-4321',
            'date_birth' => '1985-05-20',
            'education' => 'superior',
            'gender' => 'masculino',
        ];

        $medicalRecord = (object)[
            'prontuario_id' => 1,
            'prontuario_cliente_id' => 1,
            'prontuario_dt_register' => '2024-11-20',
            'prontuario_dt_update' => '2024-11-20',
            'prontuario_tx_family_history' => 'Histórico familiar inclui casos de ansiedade generalizada na mãe e depressão no pai. Irmão mais velho também apresenta episódios de ansiedade.',
            'prontuario_tx_historico_social' => 'Paciente relata dificuldades em criar vínculos afetivos profundos. Vive sozinho em um apartamento na cidade e tem poucos amigos próximos. Relata sentir solidão frequentemente, embora participe de eventos sociais esporádicos.',
            'prontuario_tx_considerations' => 'Considerar o impacto do isolamento social na saúde mental do paciente. Indicar atividades que promovam interação social e estímulos positivos. Avaliar estratégias para lidar com crises de ansiedade durante sessões futuras.',
            'prontuario_tx_observation' => 'Paciente demonstrou resistência inicial ao processo terapêutico, mas aceitou sugestões para práticas de respiração e mindfulness. Apresenta níveis moderados de estresse e ansiedade. Recomendado acompanhamento contínuo com avaliação mensal de progresso.',
            'prontuario_st_validation_teacher' => 'N'
        ];


        return view('index.medical-record', compact('medicalRecord', 'patient'));
    }

    public function upload(Request $request, $id)
    {
        $request->validate(['file' => 'required|mimes:pdf,doc,docx,txt|max:2048']);

        $file = $request->file('file');
        $filePath = $file->storeAs("sessions/$id", $file->getClientOriginalName());

        // Retorne para a página com sucesso
        return redirect()->back()->with('success', 'Arquivo enviado com sucesso!');
    }

    public function view($id, $file)
    {
        //$filePath = public_path("files/patients/$id/$file");
        $filePath = public_path("files/patients/1/PRONT_1_20241120190100.pdf");

        if (!file_exists($filePath)) {
            abort(404, 'Arquivo não encontrado.');
        }

        return response()->file($filePath);
    }

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
