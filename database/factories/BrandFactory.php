<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => ucfirst($this->faker->word()),
            "slug" => Str::slug($this->faker->company()),
            "on_homepage" => random_int(1, 10) > 6 ? true : false,
            "thumbnail" => '/storage/images/' . $this->faker->image(
                'storage/app/public/images',
                65,
                65,
                'animals',
                false
            )

        ];
    }
}
