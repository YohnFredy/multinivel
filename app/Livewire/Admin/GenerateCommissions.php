<?php

namespace App\Livewire\Admin;

use App\Models\Commissions;
use App\Models\Income;
use App\Models\UserPoint;
use Livewire\Component;

class GenerateCommissions extends Component
{


    public function generate()
    {
        $income = Income::where('status', 1)->firstOrFail();
        $ptsValue = $income->pts_value;


        $userPoints = UserPoint::all();

        foreach ($userPoints as $userPoint) {
            if ($userPoint->left_pts > $userPoint->right_pts) {

                if ($userPoint->right_pts > 5) {
                    $result = $userPoint->right_pts * 0.1;

                    Commissions::create([
                        'user_id' => $userPoint->user_id,
                        'binary_commission' => $result * $ptsValue,

                    ]);
                }
            } else {
                if ($userPoint->left_pts > 5) {
                    $result = $userPoint->left_pts * 0.1;

                    Commissions::create([
                        'user_id' => $userPoint->user_id,
                        'binary_commission' => $result * $ptsValue,

                    ]);
                }
            }
        }
    }



    public function render()
    {
        return view('livewire..admin.generate-commissions');
    }
}
