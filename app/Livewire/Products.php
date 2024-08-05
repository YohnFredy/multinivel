<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Component;

class Products extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';
    public $category_id = '';


    #[On('showCategory')]
    public function updateCategory($id)
    {
        $this->category_id = $id;
        $this->search = '';
    }

    public function searchEnter()
    {
        $this->category_id = '';
        $this->resetPage();
    }

    public function cart() {
        dd('hola');
        
    }

    public function render()
    {
        $productsQuery = Product::query();

        if (!empty($this->search)) {
            $searchTerms = explode(' ', $this->search);
            foreach ($searchTerms as $term) {
                $productsQuery->where(function ($query) use ($term) {
                    $query->where('name', 'like', '%' . $term . '%')
                        ->orWhere('description', 'like', '%' . $term . '%');
                });
            }
        }

        if (!empty($this->category_id)) {
            $productsQuery->where('category_id', $this->category_id);
        }

        $products = $productsQuery->paginate(8);

        return view('livewire.products', [
            'products' => $products
        ]);
    }
}
