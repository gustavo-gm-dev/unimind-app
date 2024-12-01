<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClienteSeeder extends Seeder
{
    public function run()
    {
        $clientes = [
            [
                'cliente_usuario_id' => 1,
                'cliente_usuario_id_atualizado' => 1,
                'cliente_nome' => 'João da Silva',
                'cliente_cpf' => '123.456.789-00',
                'cliente_rg' => '12.345.678',
                'cliente_email' => 'joao.silva@unicuritiba.edu.br',
                'cliente_ddd' => '41',
                'cliente_telefone' => '99876-5432',
                'cliente_dt_nascimento' => '1985-03-15',
                'cliente_genero' => 'M',
                'cliente_escolaridade' => 'Ensino Médio',
                'cliente_periodo_preferencia' => 'M',
                'cliente_st_confirma_dados' => true,
                'cliente_tipo_atendimento' => 'PRESENCIAL',
                'cliente_st_cadastro' => true,
            ],
            [
                'cliente_usuario_id' => 1,
                'cliente_usuario_id_atualizado' => 1,
                'cliente_nome' => 'Maria Oliveira',
                'cliente_cpf' => '987.654.321-00',
                'cliente_rg' => '98.765.432',
                'cliente_email' => 'maria.oliveira@unicuritiba.edu.br',
                'cliente_ddd' => '41',
                'cliente_telefone' => '99876-1234',
                'cliente_dt_nascimento' => '1990-07-20',
                'cliente_genero' => 'F',
                'cliente_escolaridade' => 'Ensino Superior',
                'cliente_periodo_preferencia' => 'T',
                'cliente_st_confirma_dados' => true,
                'cliente_tipo_atendimento' => 'REMOTO',
                'cliente_st_cadastro' => true,
            ],
            [
                'cliente_usuario_id' => 1,
                'cliente_usuario_id_atualizado' => 1,
                'cliente_nome' => 'Carlos Andrade',
                'cliente_cpf' => '654.321.987-00',
                'cliente_rg' => '65.432.198',
                'cliente_email' => 'carlos.andrade@unicuritiba.edu.br',
                'cliente_ddd' => '41',
                'cliente_telefone' => '99765-4321',
                'cliente_dt_nascimento' => '1978-12-10',
                'cliente_genero' => 'M',
                'cliente_escolaridade' => 'Pós-Graduação',
                'cliente_periodo_preferencia' => 'N',
                'cliente_st_confirma_dados' => true,
                'cliente_tipo_atendimento' => 'PRESENCIAL',
                'cliente_st_cadastro' => true,
            ],
        ];

        foreach ($clientes as $cliente) {
            Cliente::create($cliente);
        }
    }
}
