<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{

    public function run(): void
    {
        $categories = Category::factory(3)->create();
        Product::factory(25)->hasAttached($categories)->create();
    }
}
