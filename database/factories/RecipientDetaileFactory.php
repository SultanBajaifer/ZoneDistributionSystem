<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Http\Controllers\api\RecipientDetaileController;

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
        $recipientDetaileController = new RecipientDetaileController();
        $barcode = $recipientDetaileController->Barcode();
        return [
            'name' => $this->faker->name(),
            'phoneNum' => $this->faker->randomNumber(9),
            'barcode' => $barcode,
            'birthday' => $this->faker->date('Y-m-d'),
            'familyCount' => $this->faker->randomDigit(),
            'averageSalary' => $this->faker->randomFloat(),
            'workFor' => substr($this->faker->company(), 0, 20),
            'passportNum' => $this->faker->randomNumber(9),
            'addresID' => $this->faker->randomNumber(20),
            'socialState' => $this->faker->text(20),
            'residentType' => $this->faker->text(10),
            'image' => ''
        ];
    }
}