<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NecessidadeSeeder extends Seeder
{
    public function run()
    {
        $necessidades = [
            ['necessidade_nome' => 'Deficiência Visual'],
            ['necessidade_nome' => 'Deficiência Auditiva'],
            ['necessidade_nome' => 'Autismo'],
            ['necessidade_nome' => 'Mobilidade Reduzida'],
            ['necessidade_nome' => 'Deficiência Intelectual'],
        ];

        foreach ($necessidades as $necessidade) {
            DB::table('necessidades')->insert($necessidade);
        }
    }
}
