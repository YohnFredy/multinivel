<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product>
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
            'name' => $this->faker->word,
            'slug' => Str::slug($this->faker->unique()->word),
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'stock' => $this->faker->numberBetween(0, 100),
            'category_id' => Category::inRandomOrder()->first()->id,
            'subcategory_id' => Subcategory::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
        ];
    }
}
