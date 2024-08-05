<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Crear 10 categorías principales
        Category::factory()
            ->count(10)
            ->create()
            ->each(function ($category) {
                // Crear 10 subcategorías para cada categoría principal
                Category::factory()
                    ->count(5)
                    ->create(['parent_id' => $category->id])
                    ->each(function ($subCategory) {
                        // Crear 10 sub-subcategorías para cada subcategoría
                        Category::factory()
                            ->count(5)
                            ->create(['parent_id' => $subCategory->id]);
                    });
            });
    }
}
