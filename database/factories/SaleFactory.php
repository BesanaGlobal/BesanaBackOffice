<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $idSale = rand(100, 100000);
        return [
            'idSale' => $idSale,
            'idWebsite' => 1,
            'idProd' => $this->faker->randomNumber(),
            'datetimeb' => $this->faker->dateTime(),
            'idAffiliated' =>  $this->faker->randomNumber(),
            'price' => $this->faker->randomFloat(2),
            'ActivatedBuy' => 1,
            'TipoPago' => $this->faker->firstName(),
            'webShop' => $this->faker->name(),
            'WebNameClient' => $this->faker->name(),
            'WebEmailClient' => $this->faker->email(),
            'Shipping' => $this->faker->randomFloat(0,1,1)
        ];
    }
}
