<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class StockMaterialesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name(),
            'caracteristicas' => $this->faker->text(250),
            'marca' => $this->faker->company(),
            'colores' => json_encode([$this->faker->hexColor()]),
            'imagen' => $this->faker->image(),
        ];
    }
}
