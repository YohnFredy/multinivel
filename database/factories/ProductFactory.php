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
        $parentCategoryId = Category::whereNull('parent_id')->inRandomOrder()->value('id');
        Category::where('id', $parentCategoryId)->update(['is_active' => 1]);

        $subCategoryId = Category::where('parent_id', $parentCategoryId)->inRandomOrder()->value('id');
        Category::where('id', $subCategoryId)->update(['is_active' => 1]);

        $subSubCategoryId = Category::where('parent_id', $subCategoryId)->inRandomOrder()->value('id');
        Category::where('id', $subSubCategoryId)->update(['is_active' => 1]);

        $brand = Brand::inRandomOrder()->first()->id;
        Brand::where('id', $brand)->update(['is_active' => 1]);

        return [
            'name' => $this->faker->word,
            'slug' => Str::slug($this->faker->unique()->word),
            'description' => $this->faker->paragraph,
            /* 'price' => $this->faker->randomFloat(2, 10, 1000), */
            'price' => 28.75,
            'commission_income' =>5.71,
            'pts' => 5,
            'specifications' => $this->faker->paragraph,
            'information' => $this->faker->paragraph,
            'stock' => $this->faker->numberBetween(0, 100),
            'category_id' => $subSubCategoryId,
            'brand_id' => $brand,
        ];
    }
}
