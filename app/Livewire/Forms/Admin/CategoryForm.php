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

    public $category_id;

    public function store()
    {
        $this->validate();
        $category = Category::create($this->all());
    }

    public function update($category)
    {
        $this->validate();
        $category->update(
            $this->all()
        );
       
    }

}
