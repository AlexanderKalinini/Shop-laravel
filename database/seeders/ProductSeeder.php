<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{

    public function run(): void
    {
        Product::factory(25)
            ->has(Category::factory(2),)
            ->create();
    }
}
