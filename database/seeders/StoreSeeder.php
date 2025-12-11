<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class StoreSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            Store::create([
                'name' => $faker->company,
                'address' => $faker->address,
                'contact' => '081234546728',
                'opening_time' => $faker->time('H:i'),
                'closing_time' => $faker->time('H:i'),
                'image_path' => 'images/details',
            ]);
        }
    }
}
