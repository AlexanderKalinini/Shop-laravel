<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Description;
use App\Models\Option;
use App\Models\OptionValue;
use App\Models\Product;
use App\Models\Property;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {

        $properties = Property::factory(10)->create();
        Option::factory(2)->create();
        $optionValue = OptionValue::factory(10)->create();


        Category::factory(10)->has(
            Product::factory(5)
                ->hasAttached($properties, function () {
                    return ['value' => ucfirst(fake()->word())];
                })->hasAttached($optionValue, function () {
                    return ['quantity' => fake()->numberBetween(1, 1000)];
                })
                ->hasDescriptions(
                    3,
                    function (array $attributes, Product $product) {
                        return [
                            'product_id' => $product->id,
                        ];
                    }


                )
        )->create();
    }
}