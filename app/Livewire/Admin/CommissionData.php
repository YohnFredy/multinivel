<?php

namespace App\Livewire\Admin;

use App\Models\Rank;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class CommissionData extends Component
{
    use WithPagination, WithoutUrlPagination;


    public function render()
    {
        return view('livewire..admin.commission-data', [
            'ranks' => Rank::orderBy('level', 'asc')->paginate(100),
        ]);
    }
}
