<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Seeder;

class ClearImagesSeeder extends Seeder
{
    /**
     * List of directories to clear and recreate.
     *
     * @var array
     */
    protected $directories = [
        'products',
        /* 'categories',
        'subcategories', */
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        foreach ($this->directories as $directory) {
            $this->clearAndCreateDirectory(public_path("storage/{$directory}"));
        }
    }

    /**
     * Clear a directory and recreate it.
     *
     * @param string $path
     * @return void
     */
    protected function clearAndCreateDirectory(string $path): void
    {
        if (File::exists($path)) {
            File::deleteDirectory($path);
        }
        File::makeDirectory($path, 0755, true, true);
    }
}
