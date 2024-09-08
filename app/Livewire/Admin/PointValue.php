<?php

namespace App\Livewire\Admin;

use App\Models\Income;
use App\Models\UserPoint;
use Livewire\Component;

class PointValue extends Component
{
    public $ptsValue = 0;
    public $income;
    public $dolar = 4174.26;

    public function mount()
    {
        $this->income = Income::where('status', 1)->firstOrFail();
        $this->ptsValue = $this->income->pts_value;
    }

    public function updatePointValue()
    {
        $binaryPayment = $this->calculateBinaryPayment();
        $ptsValue = $this->calculatePointsValue($binaryPayment);

        $this->income->update([
            'binary_points_for_payment' => $binaryPayment,
            'pts_value' => $ptsValue,
        ]);

        $this->ptsValue = $ptsValue;
    }

    private function calculateBinaryPayment(): float
    {
        return UserPoint::all()->sum(function ($userPoint) {
            $points = min($userPoint->left_pts, $userPoint->right_pts);
            return $points > 5 ? $points : 0;
        }) * 0.1; // 10% of the total points
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
