<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => Str::ucfirst($this->faker->word(1, true)),
            "slug" => Str::slug($this->faker->word()),
            "on_homepage" => random_int(1, 10) > 6 ? true : false,
        ];
    }
}
