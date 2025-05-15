<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CustomersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $batchSize = 500; // for performance
        $totalRecords = 10000;
        $chunks = ceil($totalRecords / $batchSize);

        for ($i = 0; $i < $chunks; $i++) {
            $data = [];

            for ($j = 0; $j < $batchSize; $j++) {
                $data[] = [
                    'customer_id' => null, // assuming auto-increment in schema
                    'first_name' => $faker->firstName,
                    'last_name' => $faker->lastName,
                    'email' => $faker->unique()->safeEmail,
                    'phone' => $faker->phoneNumber,
                    'address' => $faker->streetAddress,
                    'city' => $faker->city,
                    'state' => $faker->state,
                    'zip_code' => $faker->postcode,
                    'created_at' => now(),
                ];
            }

            DB::table('customers')->insert($data);
        }
    }
}
