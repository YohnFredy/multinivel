<?php

namespace App\Livewire\Forms\Admin;

use App\Models\Category;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CategoryForm extends Form
{
    #[Validate('required|string|max:100|min:3')]
    public $name = '';

    public $slug = '';

    #[Validate('nullable|string|min:3')]
    public $description = '';

    public $newImages = [];
    public $images = [];
    public $category_id;

    public function rules()
    {
        return [
            'newImages.*' => 'image|max:1024', // Máximo 1MB por imagen
        ];
    }

    public function store()
    {
        $this->validate();
        $category = Category::create($this->all());
        $this->saveImages($category);
    }

    public function update($category)
    {
        $this->validate();
        $category->update(
            $this->all()
        );
        $this->saveImages($category);
    }

    public function saveImages($category)
    {
        foreach ($this->newImages as $image) {
            $path = $image->storeAs('categories', $image->getClientOriginalName(), 'public');
            $category->images()->create(['path' => $path]);
        }
    }
}
