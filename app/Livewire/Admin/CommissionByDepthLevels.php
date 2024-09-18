<?php

namespace App\Livewire\Admin;

use App\Models\Commission;
use App\Models\Rank;
use App\Models\Relationship;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CommissionByDepthLevels extends Component
{
    public function generate()
    {
        $commissions = Commission::where('status', '<=', 2)->orderBy('user_id', 'desc')->get();

        foreach ($commissions as $commission) {
            $levels = [];
            $total = $commission->binary_commission;

            $levels = [
                4 => ['percentage' => $total * 10 / 100],
                5 => ['percentage' => $total * 4 / 100],
                6 => ['percentage' => $total * 4 / 100],
                7 => ['percentage' => $total * 3 / 100],
                8 => ['percentage' => $total * 2 / 100],
                9 => ['percentage' => $total * 1 / 100],
                10 => ['percentage' => $total * 1 / 100],
                11 => ['percentage' => $total * 1 / 100],
                12 => ['percentage' => $total * 1 / 100],
                13 => ['percentage' => $total * 1 / 100],
                14 => ['percentage' => $total * 1 / 100],
                'total' => ['amount' => 7],
            ];
            $this->addCommissions($commission->user_id, $levels);
        }
    }
    public function addCommissions($userId, &$levels)
    {
        while (true) {
            if ($levels['total']['amount'] == 0) {
                break;
            }

            $sponsor = Relationship::where('user_id', $userId)->first();
            if (!$sponsor->parent_id) {
                break;
            }

            $currentRank = Rank::where('user_id', $sponsor->parent_id)->where('status', 1)->first();
            if ($currentRank) {
                foreach ($levels as $key => $value) {
                    if (is_int($key) && $currentRank->level >= $key) {

                        Commission::updateOrCreate(
                            ['user_id' => $sponsor->parent_id, 'status' => 1],
                            ['generational_commission' => DB::raw('generational_commission + ' . $value['percentage'])]
                        );
                        $levels['total']['amount']--;
                        unset($levels[$key]);
                    }
                }
                $userId = $sponsor->parent_id;
            } else {
                $userId = $sponsor->parent_id;
            }
        }
    }
    public function render()
    {
        return view('livewire.admin.commission-by-depth-levels');
    }
}
