<?php

namespace App\Livewire;

use App\Models\Image;
use App\Models\Product;
use Livewire\Component;

class ShowProduct extends Component
{

    public $product;
    public $count = 1;
   
    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function increment()
    {
        $this->count++;
        if ($this->count > 1000) {
            $this->count = 1000;
        }
    }

    public function decrement()
    {
        $this->count--;
        if ($this->count < 1) {
            $this->count = 1;
        }
    }

    public function render()
    {
        return view('livewire.show-product');
    }
}
