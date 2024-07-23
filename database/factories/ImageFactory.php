<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition()
    {
        return [
            // Ruta por defecto, pero utilizaremos estados para ajustar esto
            'path' => 'images/default.png',
        ];
    }

    public function product()
    {
        return $this->state(function (array $attributes) {
            return [
                'path' => 'products/' . $this->faker->image('public/storage/products', 640, 480, null, false),
            ];
        });
    }

    public function category()
    {
        return $this->state(function (array $attributes) {
            return [
                'path' => 'categories/' . $this->faker->image('public/storage/categories', 640, 480, null, false),
            ];
        });
    }

    public function subcategory()
    {
        return $this->state(function (array $attributes) {
            return [
                'path' => 'subcategories/' . $this->faker->image('public/storage/subcategories', 640, 480, null, false),
            ];
        });
    }
}
