<?php

namespace App\Livewire\Admin;

use App\Models\Commission;
use App\Models\Income;
use App\Models\Rank;
use App\Models\UserPoint;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PointValue extends Component
{
    public $ptsValue = 1.5;
    public $income;
    public $dolar = 4174.26;
    public $minimun_pts;

    public function mount()
    {
        $this->minimun_pts = config('services.multilevel.minimum_pts');
        $this->income = Income::where('status', 1)->first();
    }

    public function updatePointValue()
    {
        if ($this->income) {
            DB::table('commissions')->truncate();
            DB::table('ranks')->truncate();


            $binaryPayment = $this->calculateBinaryPayment();
            $ptsValue = $this->calculatePointsValue($binaryPayment);

            $this->income->update([
                'binary_points_for_payment' => $binaryPayment,
                'pts_value' => $ptsValue,
            ]);

            $this->ptsValue = $ptsValue;
        }
    }

    private function calculateBinaryPayment()
    {
        $points = UserPoint::all()->sum(function ($userPoint) {
            $minPts = min($userPoint->left_pts, $userPoint->right_pts);
            return $this->minimun_pts <= $minPts ? $minPts : 0;
        });

        return $points * 0.1;
    }

    private function calculatePointsValue(float $binaryPayment): float
    {
        $result = $this->income->commission_income * $this->income->pool1_percentage / 100;
        return $binaryPayment > 0 ? $result / $binaryPayment : 0;
    }

    public function render()
    {
        return view('livewire.admin.point-value');
    }
}
