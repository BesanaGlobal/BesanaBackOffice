<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Affiliate>
 */
class AffiliateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'SSN' => fake()->randomNumber(),
            'Name' => fake()->name(),
            'LastName' => fake()->lastName(),
            'AlternativePhone' => fake()->phoneNumber(),
            'WorkPhone' => fake()->phoneNumber(),
            'DateBirth' => fake()->date(),
            'Email' => fake()->email(),
            'ConfirmedEmail' => 1,
            'Address' => fake()->address(),
            'Country' => fake()->country(),
            'State' => fake()->country(),
            'City' => fake()->city(),
            'ZipCode' => fake()->countryCode(),
            'Phone' => fake()->phoneNumber(),
            'Latitude' => fake()->latitude(),
            'CreatedAt' => fake()->date(),
            'ModifiedAt' => fake()->date(),
            'Longitude' => fake()->longitude(),
            'firstBuy' => fake()->date(),
            'StatusAff'  => 1
        ];
    }
}
