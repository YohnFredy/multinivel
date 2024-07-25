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

    #[Validate('numeric|min:0')]
    public $pts = 0;

    public $tangible = 1;

    #[Validate('numeric|min:0')]
    public $stock = 0;

    public $allow_backorder = 0;

    #[Validate('required')]
    public $category_id;

    public $brand_id, $is_active = 1, $suggestedPts = 0, $newImages = [], $images = [], $product_id;

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
