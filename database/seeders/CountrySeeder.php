<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;



class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Crear países falsos
        for ($i = 0; $i < 10; $i++) {
            $country = Country::create([
                'name' => $faker->country,
                /* 'code' => strtoupper($faker->countryCode), */
            ]);

            // Crear estados falsos para cada país
            for ($j = 0; $j < 5; $j++) {
                $department = $country->department()->create([
                    'name' => $faker->state,
                    /* 'code' => strtoupper($faker->stateAbbr()), */
                ]);

                // Crear ciudades falsas para cada estado
                for ($k = 0; $k < 3; $k++) {
                    $department->cities()->create([
                        'name' => $faker->city,
                    ]);
                }
            }
        }

        $country = Country::create([
            'name' => 'Colombia',
        ]);

        $department = $country->department()->create([
            'name' => 'Valle del Cauca',
           
        ]);
    }
}
