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
            "thumbnail" => '',
            "price" => $this->faker->numberBetween(1, 10000),
            "old_price" => $this->faker->numberBetween(1, 10000),
            "brand_id" => Brand::inRandomOrder()->first()->id,
            "producer_id" => Producer::inRandomOrder()->first()->id,
            "count_estimates" => $this->faker->numberBetween(1, 100000),
            // "bread_crumbs" => $this->faker->mimeType(),
            // "characteristics" => $this->faker->paragraph(3),
            // "describe" => $this->faker->paragraph(4),
            // "options" => $this->faker->paragraph(4),
            // "rating" => $this->faker->randomFloat(1, 1, 5),
            // "estimate" => $this->faker->numberBetween(1, 10),

        ];
    }
}
