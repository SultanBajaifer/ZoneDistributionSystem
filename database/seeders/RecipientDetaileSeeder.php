<?php

namespace Database\Seeders;

use App\Models\RecipientDetaile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipientDetaileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RecipientDetaile::factory(5)->create();
    }
}