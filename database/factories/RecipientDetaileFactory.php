<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RecipientDetaile>
 */
class RecipientDetaileFactory extends Factory
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
            'phoneNum' => $this->faker->randomNumber(),
            'barcode' => $this->faker->randomNumber(),
            'birthday' => $this->faker->date('Y-m-d'),
            'averageSalary' => $this->faker->randomFloat(),
            'workFor' => substr($this->faker->company(), 0, 20),
            'passportNum' => $this->faker->randomNumber(),
            'socialState' => $this->faker->text(20),
            'residentType' => $this->faker->text(10),
            'image' => $this->faker->image()
        ];
    }
}