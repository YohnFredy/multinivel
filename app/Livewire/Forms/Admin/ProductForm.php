<?php

namespace App\Livewire\Forms\Admin;

use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductForm extends Form
{

    #[Validate('required|string|max:100|min:3')]
    public $name = '';

    public $slug = '';

    #[Validate('nullable|string|min:3')]
    public $description = '';

    #[Validate('required|numeric|min:0')]
    public $price = 0;

    public $stock = 0;

    #[Validate('required|numeric')]
    public $category_id;
    
    public $subcategory_id;
    public $brand_id;
    public $newImages = [];
    public $images = [];
    public $product_id;

    public function rules()
    {
        return [
            'newImages.*' => 'image|max:1024', // Máximo 1MB por imagen
        ];
    }

    public function store()
    {
        $this->validate();
        $product = Product::create($this->all());
        $this->saveImages($product);
    }

    public function update($product)
    {
        $this->validate();
        $product->update(
            $this->all()
        );
        $this->saveImages($product);
    }

    public function saveImages($product)
    {
        foreach ($this->newImages as $image) {
            $path = $image->storeAs('products', $image->getClientOriginalName(), 'public');
            $product->images()->create(['path' => $path]);
        }
    }
}
