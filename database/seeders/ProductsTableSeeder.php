<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();
        $cnt = 10;

        $existingData = Product::pluck('name')->toArray();

        for ($i = 0; $i < $cnt; $i++) {

            $uniqueData = $faker->unique()->word;
            while (in_array($uniqueData, $existingData)) {
                $uniqueData = $faker->unique()->word;
            }

            $existingData[] = $uniqueData;
            Product::create([
                'name' => ucwords($uniqueData),
                'description' => $faker->paragraphs(1, true),
                'price' => $faker->randomFloat(2, 5, 100),
            ]);

        }

        // Product::create([
        //     'name' => 'Apple',
        //     'description' => 'This is a sample product.',
        //     'price' => 170.00,
        // ]);

        
    }
}
