<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\Order;
use App\Models\Product;
use App\Models\State;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateOrder extends Component
{
    public $cart = [], $products = [];
    public $user_id, $quantity = 0, $reference = '';
    public $countries = [], $states =[], $cities = [];

    #[Validate]
    public $name = '', $phone = '', $envio_type = 1, $selectedCountry = '', $selectedState = '', $selectedCity = '',  $addCity = '', $address = '', $total = 0, $total_pts = 0;

    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'phone' => 'required|min:3',
            'envio_type' => 'required|in:1,2',
            'selectedCountry' => Rule::requiredIf($this->envio_type == 2),
            'selectedState' => Rule::requiredIf($this->envio_type == 2),
            'selectedCity' => Rule::requiredIf($this->envio_type == 2 && empty($this->addCity)),
            'addCity' => Rule::requiredIf($this->envio_type == 2 && empty($this->selectedCity)),
            'address' => Rule::requiredIf($this->envio_type == 2),
            'total' => 'required|numeric|min:0',
            'total_pts' => 'required|numeric|min:0',
        ];
    }

    public function mount()
    {
        $this->cart = session()->get('cart', []);
        $this->showProducts();
        $this->countries = Country::all();
    }

    public function onEnvioTypeChange()
    {
        if ($this->envio_type == 1) {
            $this->reset(
                [
                    'selectedCountry',
                    'states',
                    'selectedState',
                    'cities',
                    'selectedCity',
                    'addCity',
                    'address',
                    'reference',
                ]
            );
        }
    }

    public function updatedSelectedCountry($countryId)
    {
        $this->reset(['states', 'selectedState', 'cities', 'selectedCity', 'addCity']);
        $this->states = State::where('country_id', $countryId)->get();
    }

    public function updatedSelectedState($stateId)
    {
        $this->reset(['cities', 'selectedCity', 'addCity']);
        $this->cities = City::where('state_id', $stateId)->get();
    }

    public function updatedSelectedCity()
    {
        $this->reset('addCity');
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
            'contact' => $this->name,
            'phone' => $this->phone,
            'envio_type' => $this->envio_type,
            'total' => $this->total,
            'total_pts' => $this->total_pts,
        ];

        if ($this->envio_type == 2) {
            $orderData = array_merge($orderData, [
                'country_id' => $this->selectedCountry,
                'state_id' => $this->selectedState,
                'city_id' => $this->selectedCity,
                'city' => $this->addCity,
                'address' => $this->address,
                'reference' => $this->reference,
            ]);
        }

        $order = Order::create($orderData);

        /* session()->forget('cart');

        return redirect()->route('orders.payment', $order); */
    }

    public function render()
    {
        return view('livewire.create-order');
    }
}
