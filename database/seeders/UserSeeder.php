<?php

namespace Database\Seeders;

use Database\Factories\UserType0Factory;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;
use Illuminate\Support\Str;
use Illuminate\Contracts\Redis\Factory;
use App\Models\User;

class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->ofType('admin')->count(1)->create();

        // Generate 3 guest users using the AdminUserFactory
        User::factory()->ofType('distributer')->count(1)->create();

    }
}