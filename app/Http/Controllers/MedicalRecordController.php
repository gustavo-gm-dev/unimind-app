<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller 
{
    public function index()
    {
        $patients = collect([
            (object)[
                'id' => 1,
                'name' => 'João da Silva',
                'session' => (object)[
                    'date' => '2024-11-20',
                    'location' => 'UNICURITIBA',
                    'time' => '14:00',
                ],
                'medical_record_status' => 'iniciado',
            ],
            (object)[
                'id' => 2,
                'name' => 'Maria Oliveira',
                'session' => null,
                'medical_record_status' => 'concluido',
            ],
            (object)[
                'id' => 3,
                'name' => 'Carlos Andrade',
                'session' => (object)[
                    'date' => '2024-11-22',
                    'location' => 'Remoto',
                    'time' => '10:00',
                ],
                'medical_record_status' => null,
            ],
        ]);

        return view('index.medical-record', compact('patients'));
    }

    public function show($id)
    {
        $medicalRecord = (object)[
            'id' => $id,
            'patient' => (object)['name' => 'João da Silva'],
            'notes' => 'Paciente com histórico de hipertensão.',
            'sessions' => collect([
                (object)[
                    'id' => 1,
                    'date' => now()->subDays(10),
                    'status' => 'Concluída',
                ],
                (object)[
                    'id' => 2,
                    'date' => now(),
                    'status' => 'Pendente',
                ],
            ]),
        ];

        return view('index.medical-record', compact('medicalRecord'));
    }

    public function save(Request $request, $id)
    {
        $validatedData = $request->validate([
            'prontuario_tx_historico_familiar' => 'nullable|string|max:3000',
            'prontuario_tx_historico_social' => 'nullable|string|max:3000',
            'prontuario_tx_consideracoes' => 'nullable|string|max:3000',
            'prontuario_tx_observacao' => 'nullable|string|max:3000',
            'prontuario_st_validacao_prof' => 'required|string|in:S,N'
        ]);

        if ($id) {
            $record = MedicalRecord::findOrFail($id);
            $record->update($validatedData);
        } else {
            $validatedData['prontuario_dt_cadastro'] = now();
            MedicalRecord::create($validatedData);
        }

        return redirect()->route('medical_records.list')->with('success', 'Prontuário salvo com sucesso!');
    }

    public function edit($id)
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

        $sessions = collect([
            (object)[
                'id' => 1,
                'date' => '2024-11-20',
                'sessao_tx_principal' => 'Discussão inicial sobre ansiedade.',
                'sessao_tx_procedimento' => 'Exercícios de respiração guiada.',
                'sessao_tx_encaminhamento' => 'Recomendação para mindfulness diário.',
                'sessao_tx_observacao' => 'Paciente apresentou boa resposta aos exercícios.',
            ],
            (object)[
                'id' => 2,
                'date' => '2024-11-27',
                'sessao_tx_principal' => 'Revisão do progresso em mindfulness.',
                'sessao_tx_procedimento' => 'Discussão aberta sobre gatilhos de ansiedade.',
                'sessao_tx_encaminhamento' => 'Encaminhamento para grupo de apoio semanal.',
                'sessao_tx_observacao' => 'Paciente relatou dificuldades iniciais com os exercícios.',
            ],
        ]);

        return view('index.medical-record', compact('medicalRecord', 'patient', 'sessions'));
    }


}