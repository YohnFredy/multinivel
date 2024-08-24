<?php

namespace App\Livewire;

use App\Livewire\Forms\PruebaForm;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Livewire\Component;

class Prueba extends Component
{
    public PruebaForm $form;


    public function render()
    {
        return view('livewire.prueba');
    }
}
