<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use League\CommonMark\Reference\Reference;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateOrder extends Component
{

    public $cart = [], $products = [];
    public $countries = [], $states = [], $cities = [];
    public $user_id, $quantity = 0, $reference = '';

    #[Validate('required|min:3')]
    public $contact, $phone;

    #[Validate('required|in:1,2')]
    public $envio_type = 1;


    #[Validate('required|numeric|min:0')]
    public $total = 0, $total_pts = 0;

    #[Validate('required_if:envio_type,2')]
    public $country_id = '', $state_id = '', $city = '', $address = '';


    public function messages()
    {
        return [
            'address.required' => 'El :attribute es requirido.',
        ];
    }


    public function onEnvioTypeChange()
    {
        if ($this->envio_type == 1) {

            $this->resetValidation(
                [
                    'country_id',
                    'state_id',
                    'city',
                    'address',
                ]
            );
        }
    }

    public function validationAttributes()
    {
        return [
            'address' => 'departamento',
        ];
    }

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

        foreach ($this->products as $product) {

            $this->total += $product['quantity'] * $product['price'];
            $this->total_pts += $product['quantity'] * $product['pts'];
            $this->quantity += $product['quantity'];
        }
    }


    public function create_order()
    {
        $this->user_id = Auth::user()->id;

        $this->validate();

        $orderData = [
            'user_id' => $this->user_id,
            'contact' => $this->contact,
            'phone' => $this->phone,
            'envio_type' => $this->envio_type,
            'total' => $this->total,
            'total_pts' => $this->total_pts,
        ];

        if ($this->envio_type == 2) {
            $orderData = array_merge($orderData, [
                'country_id' => $this->country_id,
                'state_id' => $this->state_id,
                'city' => $this->city,
                'address' => $this->address,
                'reference' => $this->reference,
            ]);
        }

        /* $order = Order::create($orderData); */


        /* session()->forget('cart');

        return redirect()->route('orders.payment', $order); */
    }

    public function render()
    {
        return view('livewire.create-order');
    }
}
