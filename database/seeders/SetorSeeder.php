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
    }
}
