<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $category = ['Food','Drink','Dessert','Mix'];
        for ($i = 0; $i < 4; $i++) {
            Category::create([
                'category_name' => $category[$i],
            ]);
        }
    }
}
