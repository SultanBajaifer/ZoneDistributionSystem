<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DistributionPoint>
 */
class DistributionPointFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(20),
            'state' => $this->faker->text(12),
            'userID' => 2,
            'addressID' => $this->faker->numberBetween(1, 20),
        ];
    }
}