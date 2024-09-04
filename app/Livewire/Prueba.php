<?php

namespace App\Livewire;

use App\Livewire\Forms\PruebaForm;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Livewire\Component;

class Prueba extends Component
{

    public function render()
    {


       // Generate a lightweight, unique public order number
$publicOrderNumber = strtoupper(dechex(time()) . bin2hex(random_bytes(4)));
        dd($publicOrderNumber);





        return view('livewire.prueba');
    }
}
