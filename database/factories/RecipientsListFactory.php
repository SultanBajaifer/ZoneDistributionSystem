<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RecipientsList>
 */
class RecipientsListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => substr($this->faker->name(), 0, 50),
            "note" => $this->faker->text(353),
            "is_send" => 0,
            "distriputionPointID" => $this->faker->numberBetween(1, 5)
        ];
    }
}