<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empresa>
 */
class EmpresaFactory extends Factory
{
    protected $model = \App\Models\Empresa::class;

    public function definition()
    {
        return [
            'NOME' => $this->faker->company(),
            'CNPJ' => $this->faker->unique()->numerify('##.###.###/####-##'), // Gera um CNPJ aleatório
            'descricao' => $this->faker->company(), // Gera uma descrição aleatória (nome de empresa)
        ];
    }
}
