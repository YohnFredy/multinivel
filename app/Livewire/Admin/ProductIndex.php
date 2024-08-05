<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class ProductIndex extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '', $searchTerms;

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->images()->each(function ($image) {
            Storage::delete('public/' . $image->path);
            $image->delete();
        });
        $product->delete();
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

        return view('livewire.admin.product-index', [
            'products' => $products
        ]);
    }
}
