<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class Detalles_ProductosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name,
            'precio' => $this->faker->numberBetween(100, 1000),
            'descripcion' => $this->faker->text(250),
            'caracteristicas' => $this->faker->text(250),
            'colores' => json_encode([$this->faker->hexColor()]),
            'imagenes' => $this->faker->image(),
            'tiempo_entrega' => $this->faker->text(30),
        ];
    }
}
