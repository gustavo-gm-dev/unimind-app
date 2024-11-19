<?php

namespace App\Http\Controllers;

use App\Models\Patient; // Ou Pacient, se você renomeou o modelo
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function show($id)
    {
        // Busca o paciente pelo ID
        $pacient = Patient::findOrFail($id);

        // Retorna a view com os detalhes do paciente
        return view('pacients.show', compact('pacient'));
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
            'period' => 'manha',
            'service' => 'presencial',
        ];
        return view('index.patient', compact('patient'));
    }
    
    public function index()
    {
        // Dados fictícios
        $patients = collect([
            (object)[
                'id' => 1,
                'name' => 'João da Silva',
                'gender' => 'Masculino',
                'phone' => '41 9 9999-9999',
                'is_complete' => true,
            ],
            (object)[
                'id' => 2,
                'name' => 'Maria Oliveira',
                'gender' => 'Masculino',
                'phone' => '41 9 9999-9999',
                'is_complete' => false,
            ],
            (object)[
                'id' => 3,
                'name' => 'Carlos Andrade',
                'gender' => 'Masculino',
                'phone' => '41 9 9999-9999',
                'is_complete' => true,
            ],
        ]);
    
    
        // Retorna a view paciente
        return view('index.patient', compact('patients'));
    }    
}