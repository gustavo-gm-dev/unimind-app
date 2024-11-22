<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prontuario;
use App\Models\Cliente;

class ProntuarioSeeder extends Seeder
{
    public function run()
    {
        $clientes = Cliente::all();

        foreach ($clientes as $cliente) {
            Prontuario::create([
                'prontuario_cliente_id' => $cliente->cliente_id,
                'prontuario_tx_historico_familiar' => 'Histórico familiar de questões psicológicas leves.',
                'prontuario_tx_historico_social' => 'Apresenta dificuldades sociais desde a adolescência.',
                'prontuario_tx_consideracoes' => 'Paciente busca melhorar habilidades interpessoais.',
                'prontuario_tx_observacao' => 'Recomenda-se acompanhamento semanal.',
                'prontuario_st_validacao_prof' => true,
            ]);
        }
    }
}
