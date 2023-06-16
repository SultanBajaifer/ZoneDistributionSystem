<?php

namespace Database\Factories;

use App\Models\User;
use DB;
use Hash;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'password' => Hash::make('password'),
            // password
            'userType' => 1,
            'addressID' => $this->faker->numberBetween(10, 20),
        ];
    }
    public function ofType($type)
    {
        switch ($type) {
            case 'admin':
                return $this->state([
                    'name' => 'Hamza',
                    'userName' => "Admin_Hamza",
                    'email' => "Hamzq@gmail.com",
                    'userType' => 1,
                ]);
            case 'distributer':
                return $this->state([
                    'name' => 'Mohammed',
                    'userName' => "Distributer_Mohammed",
                    'email' => "Mohammed@gmail.com",
                    'userType' => 0,
                ]);
            default:
                return $this;
        }
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}