<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DistributionRecord>
 */
class DistributionRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'recipientID' => $this->faker->numberBetween(1, 5),
            'recipientListID' => $this->faker->numberBetween(1, 5),
            'recipientName' => substr($this->faker->name(), 0, 50),
            'distriputionPointName' => substr($this->faker->name(), 0, 50),
            'distriputerName' => substr($this->faker->name(), 0, 50),
            'listName' => substr($this->faker->name(), 0, 50),
            'packageName' => substr($this->faker->name(), 0, 50),
            'packageID' => $this->faker->numberBetween(1, 20),
        ];
    }
}