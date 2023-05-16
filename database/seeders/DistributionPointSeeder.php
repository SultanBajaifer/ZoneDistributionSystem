<?php

namespace Database\Seeders;

use App\Models\DistributionPoint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistributionPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DistributionPoint::factory(5)->create();
    }
}
