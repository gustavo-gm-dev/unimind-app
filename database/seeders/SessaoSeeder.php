<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sessao;
use App\Models\Prontuario;

class SessaoSeeder extends Seeder
{
    public function run()
    {
        $prontuarios = Prontuario::all();

        foreach ($prontuarios as $prontuario) {
            Sessao::create([
                'sessao_prontuario_id' => $prontuario->prontuario_id,
                'sessao_dt_inicio' => now()->subDays(rand(1, 30)),
                'sessao_dt_fim' => now()->subDays(rand(0, 29)),
                'sessao_dt_cadastro' => now(),
                'sessao_dt_atualizacao' => now(),
                'sessao_tx_principal' => 'Discussão inicial sobre objetivos da terapia.',
                'sessao_tx_procedimento' => 'Identificação de áreas de melhoria social.',
                'sessao_tx_encaminhamento' => 'Nenhum.',
                'sessao_tx_observacao' => 'Paciente cooperativo.',
                'sessao_tipo_atendimento' => rand(0, 1) ? 'Presencial' : 'Remoto',
                'sessao_st_presenca' => true,
                'sessao_st_confirmado' => true,
            ]);
        }
    }
}
