<?php

namespace App\Livewire;

use App\Livewire\Forms\PruebaForm;
use App\Models\City;
use App\Models\Country;
use App\Models\Order;
use App\Models\State;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Prueba extends Component
{

    public function render()
    {
        
        return view('livewire.prueba');
    }
}
