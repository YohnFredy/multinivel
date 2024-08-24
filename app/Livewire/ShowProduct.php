<?php

namespace App\Livewire;

use App\Models\Image;
use App\Models\Product;
use Livewire\Component;

class ShowProduct extends Component
{

    public $product;
    public $quantity = 1;
    public $modalCart = false;
    public $cart = [];

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->cart = session()->get('cart', []);
    }

    public function increment()
    {
        $this->quantity++;
        if ($this->quantity > 1000) {
            $this->quantity = 1000;
        }
    }

    public function decrement()
    {
        $this->quantity--;
        if ($this->quantity < 1) {
            $this->quantity = 1;
        }
    }

    public function updatedQuantity()
    {
        if ($this->quantity < 1) {
            $this->quantity = 1;
        }
        if ($this->quantity > 1000) {
            $this->quantity = 1000;
        }
    }

    public function addToCart()
    {   

        $product = [
            'id' => $this->product->id,
            'quantity' => $this->quantity,
        ];

        $this->cart[] = $product;
        session()->put('cart', $this->cart);

        $this->modalCart = true;
    }

    public function removeFromCart($index)
    {
        unset($this->cart[$index]);
        $this->cart = array_values($this->cart);
        session()->put('cart', $this->cart);
    }

    public function render()
    {
        return view('livewire.show-product');
    }
}
