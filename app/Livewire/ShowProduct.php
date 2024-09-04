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
        $this->cart = session()->get('cart', []);

        // Busca si el producto ya está en el carrito
        $index = collect($this->cart)->search(function ($item) {
            return $item['id'] === $this->product->id;
        });

        if ($index !== false) {
            // Si el producto ya está en el carrito, actualiza la cantidad
            $this->cart[$index]['quantity'] += $this->quantity;
        } else {
            // Si el producto no está en el carrito, agrégalo
            $this->cart[] = [
                'id' => $this->product->id,
                'quantity' => $this->quantity,
            ];
        }

        // Guarda el carrito actualizado en la sesión
        session()->put('cart', $this->cart);

        // Muestra el modal del carrito
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
