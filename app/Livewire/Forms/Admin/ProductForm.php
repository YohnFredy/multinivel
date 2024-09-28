<?php

namespace App\Livewire\Forms\Admin;

use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductForm extends Form
{
    #[Validate('required|string|max:255')]
    public $name = '';
    #[Validate('nullable|string')]
    public $description = '';
    #[Validate('required|numeric|min:0')]
    public $price = '';
    #[Validate('nullable|numeric|min:0')]
    public $pts = '', $maximum_discount='';
    #[Validate('nullable|string')]
    public $specifications = '', $information = '';
    #[Validate('required|boolean')]
    public $tangible = '';
    #[Validate('nullable|integer|min:0')]
    public $stock = '';
    #[Validate('required|boolean')]
    public $allow_backorder = '';
    #[Validate('required|exists:categories,id')]
    public $category_id = '';
    #[Validate('nullable|exists:brands,id')]
    public $brand_id;
    #[Validate('required|boolean')]
    public $is_active = '';

    public $newImages = [], $images = [];
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
