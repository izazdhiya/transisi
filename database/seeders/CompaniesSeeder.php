<?php

namespace Database\Seeders;

use App\Models\Companies;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $companies = new Companies();

        // $logoPath = $faker->image(storage_path('app/public/company'), 100, 100, null, false);

        $listCompany = ['Purdy-Crona', 'Thiel-Metz', 'Wyman Group'];

        foreach ($listCompany as $companyName) {
            $companies->create([
                'name' => $companyName,
                'email' => $faker->email(),
                'logo' => $faker->imageUrl(),
                'website' => $faker->url(),
            ]);
        }
    }
}
