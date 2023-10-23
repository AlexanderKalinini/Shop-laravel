<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {

        Product::factory()->count(200)->create();

        $count = Product::count();

        for ($i = 1; $i < $count; $i++) {
            $categorId = Category::inRandomOrder()->first()->id;
            $productId = Product::inRandomOrder()->first()->id;
            DB::table('category_product')->insert([
                "category_id" => $i <= Category::count() ? $i : $categorId,
                'product_id' => $i <= Category::count() ? $i : $productId,
            ]);
        }
    }
}
