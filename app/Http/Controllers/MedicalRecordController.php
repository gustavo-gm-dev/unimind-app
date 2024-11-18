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
                'sessions_active_count' => 2
            ],
            (object)[
                'id' => 2,
                'name' => 'Maria Oliveira',
                'sessions_active_count' => 1
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

}