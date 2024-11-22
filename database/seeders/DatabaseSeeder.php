<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ClienteSeeder::class,
            NecessidadeSeeder::class,
            ClienteNecessidadeSeeder::class,
            ProntuarioSeeder::class,
            ArquivoSeeder::class,
            SessaoSeeder::class,
        ]);
    }
}
