<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use Livewire\Component;

class Categories extends Component
{
    public $categories, $brands, $brand_id;

    public function mount()
    {
        $this->categories = Category::whereNull('parent_id')->where('is_active', 1)->get();
        $this->brands = Brand::all();
    }

    public function category($category_id)
    {
        $this->dispatch('showCategory', id: $category_id);
    }

    public function render()
    {
        return view('livewire.categories');
    }
}
