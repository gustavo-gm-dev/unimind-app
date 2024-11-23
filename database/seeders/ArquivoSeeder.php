<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Arquivo;
use App\Models\Prontuario;

class ArquivoSeeder extends Seeder
{
    public function run()
    {
        $prontuarios = Prontuario::all(); // Obter todos os prontuários existentes

        foreach ($prontuarios as $prontuario) {
            // Criar 1 ou mais arquivos para cada prontuário
            for ($i = 1; $i <= rand(1, 3); $i++) {
                Arquivo::create([
                    'arquivo_prontuario_id' => $prontuario->prontuario_id, // Associar diretamente ao prontuário
                    'arquivo_url' => "files/patients/1/PRONT_1_20241120190100.pdf",
                    'arquivo_dt_realizada' => now()->subDays(rand(1, 30))->format('Y-m-d'),
                ]);
            }
        }
    }
}
