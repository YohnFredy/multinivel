<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ProductList extends Component
{
    public $category_id;
    public $subcategory_id;

    #[Layout('layouts.app')]
    public function render()
    {
        // Consulta los productos según la categoría o subcategoría seleccionada
        $query = Product::query();

        if ($this->category_id) {
            $query->whereHas('subcategory', function ($query) {
                $query->where('category_id', $this->category_id);
            });
        }

        if ($this->subcategory_id) {
            $query->where('subcategory_id', $this->subcategory_id);
        }

        $products = $query->get();

        return view('livewire.product-list', [
            'products' => $products,
            'categories' => Category::all(),
            'subcategories' => Subcategory::where('category_id', $this->category_id)->get(),
        ]);
    }

    public function updatedCategoryId()
    {
        $this->subcategory_id = null;
    }
}
