<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Producer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => ucfirst($this->faker->words(3, true)),
            "thumbnail" => '/storage/images/' . $this->faker->image('storage/app/public/images', 245, 320, null, false),
            "price" => $this->faker->numberBetween(1, 10000),
            "old_price" => $this->faker->numberBetween(1, 10000),
            "brand_id" => Brand::inRandomOrder()->first()->id,
            "producer_id" => Producer::inRandomOrder()->first()->id,
            "count_estimates" => $this->faker->numberBetween(1, 100000),
        ];
    }
}
