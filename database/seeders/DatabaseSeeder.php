<?php

namespace Database\Seeders;

use App\Models\RecipientsList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AddressSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PackageSeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(RecipientDetaileSeeder::class);
        $this->call(DistributionPointSeeder::class);
        $this->call(RecipientsListSeeder::class);
        $this->call(DistributionRecordSeeder::class);

    }
}