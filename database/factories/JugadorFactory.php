<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jugador>
 */
class JugadorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombres' => fake()->firstName(),
            'apellidos' => fake()->lastName(),
            'identidad' => fake()->unique()->numerify('0703-######-#####'),
            'edad' => fake()->numberBetween(18, 40),
            'nacionalidad' => fake()->country(),
            'posicion_juego' => fake()->randomElement([
                'Portero', 'Defensa', 'Centrocampista', 'Delantero'
            ]),
            'fecha_nacimiento' => fake()->date(),
            'equipo_id' => fake()->numberBetween(1, 30),
        ];
    }
}
