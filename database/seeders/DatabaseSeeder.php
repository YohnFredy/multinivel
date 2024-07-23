<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Ejecutar el seeder que borra las imágenes
        $this->call(ClearImagesSeeder::class);

        User::factory()->create([
            'name' => 'Yohn Fredy',
            'last_name' => 'Guapacha Hurtado',
            'identification_card' => 94154629,
            'username' => 'master',
            'email' => 'fredy.guapacha@gmail.com',
            'password' => bcrypt('123'),
        ]);
        User::factory(30)->create();
        $this->call(RelationshipSeeder::class);

        $categories = Category::factory(4)->create()->each(function ($category) {
            $category->images()->createMany(
                Image::factory(1)->category()->make()->toArray()
            );
        });

        $subcategories = Subcategory::factory(10)->create()->each(function ($subcategory) {
            $subcategory->images()->createMany(
                Image::factory(1)->subcategory()->make()->toArray()
            );
        });

        Brand::factory(10)->create();

        Product::factory(20)->create()->each(function ($product) {
            $product->images()->createMany(
                Image::factory(1)->product()->make()->toArray()
            );
        }); 
    }
}
