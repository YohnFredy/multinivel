<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\Admin\ProductForm;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Subcategory;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ProductController extends Component
{

    use WithPagination, WithoutUrlPagination, WithFileUploads;

    public ProductForm $form;
    public $updateMode = false, $modalProduct = false;
    public $categories, $brands;
    public $search = '', $searchTerms;

    public function mount()
    {
        $this->categories = Category::all();
        $this->brands = Brand::all();
    }

    public function createProduct()
    {
        $this->modalProduct = true;
        $this->updateMode = false;
    }

    public function updatedModalProduct()
    {
        if ($this->updateMode == true) {
            $this->form->reset();
        }
    }

    public function save()
    {
        $this->form->store();
        $this->form->reset();
        session()->flash('message', 'Producto creado exitosamente.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->form->product_id = $id;
        $this->form->name = $product->name;
        $this->form->description = $product->description;
        $this->form->price = $product->price;
        $this->form->pts = $product->pts;
        $this->form->tangible = $product->tangible;
        $this->form->stock = $product->stock;
        $this->form->allow_backorder = $product->allow_backorder;
        $this->form->category_id = $product->category_id;
        $this->form->brand_id = $product->brand_id;
        $this->form->is_active = $product->is_active;
        $this->form->images = $product->images->pluck('path')->toArray();

        // Debugging
    /* dd($this->form->is_active, $this->form->tangible, $this->form->allow_backorder); */
        $this->updateMode = true;
        $this->modalProduct = true;
    }

    public function update()
    {
        $product = Product::find($this->form->product_id);
        $this->form->update($product);
        $this->form->reset();
        $this->modalProduct = false;
        $this->edit($product->id);
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->images()->each(function ($image) {
            Storage::delete('public/' . $image->path);
            $image->delete();
        });

        $product->delete();
        session()->flash('message', 'Producto eliminado exitosamente.');
    }

    public function removeImage($path)
    {
        $this->form->images = array_filter($this->form->images, fn ($image) => $image !== $path);
        Storage::delete('public/' . $path);
        Image::where('path', $path)->delete();
    }

    public function searchEnter()
    {
        $this->searchTerms = array_filter(explode(' ', $this->search));
        $this->resetPage();
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        $products = Product::query();
        if (!empty($this->searchTerms)) {
            foreach ($this->searchTerms as $term) {
                $products->where(function ($query) use ($term) {
                    $query->where('name', 'like', '%' . $term . '%')
                        ->orWhere('description', 'like', '%' . $term . '%');
                });
            }
        }

        $products = $products->paginate(5);

        if ($this->form->price) {
            $result = $this->form->price * 20 / 100;
            $this->form->suggestedPts = number_format($result, 2, '.', ',');
        }

        return view('livewire.admin.product-controller', [
            'products' => $products,
        ]);
    }
}
