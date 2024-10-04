<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class Cart extends Component
{
    public $cart = [];
    public $products = [];
    public $quantity = 1;
    public $total;


    public function mount()
    {
        $this->cart = session()->get('cart', []);
        $this->showProducts();
    }

    public function showProducts()
    {
        $this->products = [];
        foreach ($this->cart as $index => $item) {
            $product = Product::find($item['id']);
            $this->products[] = [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'pts' => $product->pts,
                'path' => $product->latestImage->path,
                'quantity' => $item['quantity'],
                'index' => $index,
            ];
        }
    }

    public function upadatedQuantity($id) {}

    public function increment($index)
    {
        if ($this->cart[$index]['quantity'] <= 1000) {
            $this->cart[$index]['quantity'] += 1;
            session()->put('cart', $this->cart);
            $this->showProducts();
        }
    }

    public function decrement($index)
    {
        if ($this->cart[$index]['quantity'] > 1) {
            $this->cart[$index]['quantity'] -= 1;
            session()->put('cart', $this->cart);
            $this->showProducts();
        }
    }

    public function updatedProducts($value, $name)
    {
        // Parseamos el index y la propiedad de la entrada que fue actualizada
        list($index, $property) = explode('.', $name);

        if ($property === 'quantity') {
            // Convertimos el valor ingresado a un entero y limitamos el rango entre 1 y 1000
            $value = max(1, min(1000, (int)$value));
            $this->cart[$index]['quantity'] = $value;
            session()->put('cart', $this->cart);
            $this->showProducts();
        }
    }

    public function removeFromCart($index)
    {
        unset($this->cart[$index]);
        $this->cart = array_values($this->cart);
        session()->put('cart', $this->cart);

        $this->showProducts();
    }

    public function render()
    {
        $this->quantity = 0;
        $this->total = 0;
        foreach ($this->products as $product) {

            $this->total += $product['quantity'] * $product['price'];
            $this->quantity += $product['quantity'];
        }

        return view('livewire.cart');
    }
}
