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
        $i = 0;
        if (DB::table('users')->count() > 0) {
            $i = 1;
            $name = 'Hamza';
            $userName = 'Admin';
        } else {
            $i = 0;
            $name = $this->faker->name();
            $userName = $this->faker->name();
        }
        return [
            'name' => $name,
            'userName' => $userName,
            'password' => Hash::make('password'),
            // password
            'email' => $this->faker->unique()->safeEmail(),
            'userType' => $i,
            'addressID' => $this->faker->numberBetween(10, 20),
        ];
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