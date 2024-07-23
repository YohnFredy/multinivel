<?php

namespace App\Livewire\Forms\Admin;

use App\Models\Subcategory;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SubcategoryForm extends Form
{

    #[Validate('required|string|max:100|min:3')]
    public $name = '';

    public $slug = '';

    #[Validate('nullable|string|min:3')]
    public $description = '';

    #[Validate('required|numeric')]
    public $category_id;
    
    public $newImages = [];
    public $images = [];
    public $subcategory_id;

    public function rules()
    {
        return [
            'newImages.*' => 'image|max:1024', // Máximo 1MB por imagen
        ];
    }
    
    public function store()
    {
        $this->validate();
        $subcategory = Subcategory::create($this->all());
        $this->saveImages($subcategory);
    }

    public function update($subcategory)
    {
        $this->validate();
        $subcategory->update(
            $this->all()
        );
        $this->saveImages($subcategory);
    }

    public function saveImages($subcategory)
    {
        foreach ($this->newImages as $image) {
            $path = $image->storeAs('subcategories', $image->getClientOriginalName(), 'public');
            $subcategory->images()->create(['path' => $path]);
        }
    }
}
