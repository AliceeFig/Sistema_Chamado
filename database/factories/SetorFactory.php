<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SetorFactory extends Factory
{
    protected $model = \App\Models\Setor::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->word(),
        ];
    }
}
