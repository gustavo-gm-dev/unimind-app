<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;

class ClienteNecessidadeSeeder extends Seeder
{
    public function run()
    {
        // Obtemos os IDs de clientes e necessidades existentes
        $clientes = Cliente::all();
        $necessidades = DB::table('necessidades')->pluck('necessidade_id');

        // Associa cada cliente a uma ou mais necessidades especiais
        foreach ($clientes as $cliente) {
            // Cada cliente será vinculado a uma ou mais necessidades especiais
            $necessidadesAleatorias = $necessidades->random(rand(1, 2)); // De 1 a 2 necessidades especiais

            foreach ($necessidadesAleatorias as $necessidadeId) {
                DB::table('cliente_necessidades')->insert([
                    'cliente_id' => $cliente->cliente_id,
                    'necessidade_id' => $necessidadeId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
