<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipo>
 */
class EquipoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->company(),
            'fecha_fundacion' => fake()->date(),
            'codigo' => fake()->unique()->bothify('EQ-###??'),
            'director_tecnico' => fake()->name(),
            'categoria' => fake()->randomElement([
                'Primera división',
                'Segunda división',
                'Juvenil',
            ]),
            'dueño' => fake()->name(),
            'user_id' => fake()->numberBetween(1, 10),
        ];
    }
}
