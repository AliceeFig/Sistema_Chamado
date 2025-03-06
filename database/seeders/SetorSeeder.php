<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setor;

class SetorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setor::create(['nome' => 'TI']);
        Setor::create(['nome' => 'Financeiro']);
        Setor::create(['nome' => 'Recursos Humanos']);

    foreach ($setores as $setor) {
        // Verifica se o setor já existe antes de adicionar
        Setor::firstOrCreate(['nome' => $setor]);
    }
    }
}
