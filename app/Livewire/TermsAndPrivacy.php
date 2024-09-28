<?php

namespace App\Livewire;

use Livewire\Component;

class TermsAndPrivacy extends Component
{
    public bool $terms = false;
    public bool $privacy = false;


    public function service(){
        $this->terms = true;
    }

    public function policy(){
        $this->privacy = true;
    }

    public function render()
    {
        return view('livewire.terms-and-privacy');
    }
}
