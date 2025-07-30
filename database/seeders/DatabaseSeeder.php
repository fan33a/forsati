<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            WorkFieldSeeder::class,
            EducationLevelSeeder::class,
            CompanySeeder::class,
            JobSeeder::class,
            FaqSeeder::class,
            PolicySeeder::class,
        ]);
    }
}
