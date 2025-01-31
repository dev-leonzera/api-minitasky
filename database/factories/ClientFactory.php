<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'nome' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'fone' => $this->faker->phoneNumber(),
            'data_contrato' => now(),
            'dia_vencimento' => $this->faker->numberBetween(1, 31),
            'ativo' => $this->faker->boolean(),
            'mensalista' => $this->faker->boolean(),
            'tipo' => $this->faker->randomElement(['pf', 'pj']),
        ];
    }
}
