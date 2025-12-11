<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $faker = Faker::create();

        $storeIds = Store::pluck('id')->toArray();
        $categoryIds = Category::pluck('id')->toArray();
        for ($i = 0; $i < 10; $i++) {
            Product::create([
                'name'           => $faker->words(3, true),
                'price'          => $faker->numberBetween(5000, 50000),
                'description'    => $faker->sentence(10),
                'image_path'     => 'images/burger.jpg',
                'status'         => $faker->randomElement(['active', 'inactive']),
                'total_quantity' => $faker->numberBetween(1, 100),
                'pickup_duration' => $faker->numberBetween(60, 120),
                'store_id' => $faker->randomElement($storeIds),
                'category_id' => $faker->randomElement($categoryIds),
            ]);
        }
    }
}
