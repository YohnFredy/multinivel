<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;

class ProductCrud extends Component
{
    use WithFileUploads;

    public $products, $name, $description, $price, $slug, $product_id;
    public $images = [];
    public $newImages = [];
    public $updateMode = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'newImages.*' => 'image|max:1024', // Máximo 1MB por imagen
    ];

    #[Layout('components.layouts.admin')]
    public function render() {
        $this->products = Product::with('images')->get();
        return view('livewire.product-crud');
    }

    public function resetInputFields() {
        $this->name = '';
        $this->description = '';
        $this->price = '';
        $this->images = [];
        $this->newImages = [];
        $this->product_id = null;
        $this->updateMode = false;
    }

    public function store() {
        $this->validate();

        $product = Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => 0, 
            'category_id' =>1,
        ]);

        foreach ($this->newImages as $image) {
            $path = $image->storeAs('products', $image->getClientOriginalName(), 'public');
            $product->images()->create(['path' => $path]);
        }

        session()->flash('message', 'Producto creado exitosamente.');

        $this->resetInputFields();
    }

    public function edit($id) {
        $product = Product::findOrFail($id);
        $this->product_id = $id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->images = $product->images->pluck('path')->toArray();

        $this->updateMode = true;
    }

    public function update() {
        $this->validate();

        $product = Product::find($this->product_id);
        $product->update([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
        ]);

        foreach ($this->newImages as $image) {
            $path = $image->storeAs('products', $image->getClientOriginalName(), 'public');
            $product->images()->create(['path' => $path]);
        }

        session()->flash('message', 'Producto actualizado exitosamente.');

        $this->resetInputFields();
    }

    public function delete($id) {
        $product = Product::findOrFail($id);
        $product->images()->each(function ($image) {
            Storage::delete('public/' . $image->path);
            $image->delete();
        });
        $product->delete();
        session()->flash('message', 'Producto eliminado exitosamente.');
    }

    public function removeImage($path) {
        $this->images = array_filter($this->images, fn($image) => $image !== $path);
        Storage::delete('public/' . $path);
        Image::where('path', $path)->delete();
    }
}

