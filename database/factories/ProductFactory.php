<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'img' => Str::random(10),
            'description' => $this->faker->paragraph(),
            'idLine' => $this->faker->randomNumber(10),
            'price' => $this->faker->randomFloat(2,2),
            'active' => 1,
            'puntos' => 10
        ];
    }
}
