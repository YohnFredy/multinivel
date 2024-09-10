<?php

namespace App\Livewire\Admin;

use App\Models\Commission;
use App\Models\Rank;
use App\Models\Relationship;
use App\Models\UserPoint;
use Livewire\Component;

class UpdateRank extends Component
{
    public $rankRules;

    // Actualiza los rangos de los usuarios que han comisionado en el sistema
    public function updateRanks()
    {
        // Obtenemos los usuarios con comisiones en estado válido, ordenados por su ID de usuario
        $commissions = Commission::where('status', '<=', 2)
            ->orderBy('user_id', 'desc')
            ->get();

        foreach ($commissions as $commission) {
            $this->updateUserRank($commission->user->id);
        }
    }

    // Actualiza el rango de un usuario específico
    private function updateUserRank($userId)
    {
        // Por defecto, el rango inicial es 1
        $rank = 1;

        // Obtener usuarios directos del usuario comisionado
        $directReferrals = Relationship::where('parent_id', $userId)->get();
        $directCount = $directReferrals->count();

        // Obtenemos el nivel inicial basado en la cantidad de referidos directos
        $initialLevel = $this->calculateInitialLevel($directCount, $userId);

        // Si el nivel es mayor a 1, verificamos si cumple los requisitos para obtener un rango mayor
        if ($initialLevel > 1) {
            $rank = $this->validateRankCriteria($directReferrals, $initialLevel);
        }

        // Asignamos el rango actualizado al usuario
        Rank::updateOrCreate(
            ['user_id' => $userId, 'status' => 1],
            ['level' => $rank]
        );
    }

    // Valida si un usuario cumple con los requisitos para ascender de rango
    private function validateRankCriteria($directReferrals, $level)
    {
        $rankRules = $this->getRankCriteria($level);
        $assignedRank = 0;
        $attempt = 0;

        while ($attempt < 10) {
            foreach ($directReferrals as $referral) {
                $currentRank = Rank::where('user_id', $referral->user_id)
                    ->where('status', 1)
                    ->first();

                if ($currentRank) {
                    $this->processCurrentRank($currentRank, $rankRules);
                } else {
                    $rankKey = $this->validateDescendantRanks($referral->user_id, $rankRules);
                    $this->processRankKey($rankKey, $rankRules);
                }

                // Verificamos si se cumplen todos los requisitos de rango
                if ($rankRules['total']['quantity'] <= 0) {
                    $assignedRank = $level;
                    break;
                }
            }

            if ($assignedRank == 0) {
                if ($level >= 3) {
                    $level--;
                    $rankRules = $this->getRankCriteria($level);
                } else {
                    $assignedRank = 1;
                    break;
                }
            } else {
                break;
            }

            $attempt++;
        }

        return $assignedRank;
    }

    // Procesa el rango actual y ajusta las reglas de rango según corresponda
    private function processCurrentRank($currentRank, &$rankRules)
    {
        foreach ($rankRules as $key => $rule) {
            if ($currentRank->level >= $key) {
                $rankRules[$key]['quantity']--;
                $rankRules['total']['quantity']--;

                if ($rankRules[$key]['quantity'] == 0) {
                    unset($rankRules[$key]);
                }
                break;
            }
        }
    }

    // Valida los rangos de los descendientes de un usuario
    private function validateDescendantRanks($userId, &$rankRules)
    {
        $descendants = Relationship::where('parent_id', $userId)->get();
        $foundKey = 0;

        foreach ($descendants as $descendant) {
            $currentRank = Rank::where('user_id', $descendant->user_id)
                ->where('status', 1)
                ->first();

            if ($currentRank) {
                $foundKey = $this->processRankKey($currentRank->level, $rankRules);
            } else {
                $foundKey = $this->validateDescendantRanks($descendant->user_id, $rankRules);
            }

            if ($foundKey > 0) {
                break;
            }
        }

        return $foundKey;
    }

    // Procesa una clave de rango y ajusta las reglas de rango si es necesario
    private function processRankKey($key, &$rankRules)
    {
        if ($key > 0 && isset($rankRules[$key])) {
            $rankRules[$key]['quantity']--;
            $rankRules['total']['quantity']--;
            if ($rankRules[$key]['quantity'] == 0) {
                unset($rankRules[$key]);
            }
        }

        return $key;
    }
    // Devuelve las reglas de rango según el nivel del usuario
    private function getRankCriteria($level)
    {
        $rankRules = [];

        switch ($level) {
            case 11:
                $rankRules = [9 => ['minPoints' => 280, 'quantity' => 1], 8 => ['minPoints' => 184, 'quantity' => 1], 7 => ['minPoints' => 96, 'quantity' => 1], 5 => ['minPoints' => 48, 'quantity' => 1], 4 => ['minPoints' => 32, 'quantity' => 1], 3 => ['minPoints' => 24, 'quantity' => 1], 'total' => ['quantity' => 6]];
                break;
            case 10:
                $rankRules = [8 => ['minPoints' => 184, 'quantity' => 1], 7 => ['minPoints' => 96, 'quantity' => 1], 6 => ['minPoints' => 72, 'quantity' => 1], 5 => ['minPoints' => 48, 'quantity' => 1], 4 => ['minPoints' => 32, 'quantity' => 1], 'total' => ['quantity' => 5]];
                break;
            case 9:
                $rankRules = [7 => ['minPoints' => 96, 'quantity' => 2], 5 => ['minPoints' => 48, 'quantity' => 1], 3 => ['minPoints' => 24, 'quantity' => 1], 2 => ['minPoints' => 16, 'quantity' => 1], 'total' => ['quantity' => 5]];
                break;
            case 8:
                $rankRules = [7 => ['minPoints' => 96, 'quantity' => 1], 5 => ['minPoints' => 48, 'quantity' => 1], 3 => ['minPoints' => 24, 'quantity' => 1], 2 => ['minPoints' => 16, 'quantity' => 1], 'total' => ['quantity' => 4]];
                break;
            case 7:
                $rankRules = [5 => ['minPoints' => 48, 'quantity' => 1], 4 => ['minPoints' => 32, 'quantity' => 1], 2 => ['minPoints' => 16, 'quantity' => 2], 'total' => ['quantity' => 4]];
                break;
            case 6:
                $rankRules = [4 => ['minPoints' => 32, 'quantity' => 1], 3 => ['minPoints' => 24, 'quantity' => 1], 2 => ['minPoints' => 16, 'quantity' => 1], 'total' => ['quantity' => 3]];
                break;
            case 5:
                $rankRules = [3 => ['minPoints' => 24, 'quantity' => 1], 2 => ['minPoints' => 16, 'quantity' => 1], 1 => ['minPoints' => 8, 'quantity' => 1], 'total' => ['quantity' => 3]];
                break;
            case 4:
                $rankRules = [3 => ['minPoints' => 24, 'quantity' => 1], 1 => ['minPoints' => 8, 'quantity' => 2], 'total' => ['quantity' => 3]];
                break;
            case 3:
                $rankRules = [2 => ['minPoints' => 16, 'quantity' => 1], 1 => ['minPoints' => 8, 'quantity' => 1], 'total' => ['quantity' => 2]];
                break;
            case 2:
                $rankRules = [1 => ['minPoints' => 8, 'quantity' => 2], 'total' => ['quantity' => 2]];
                break;
        }

        return $rankRules;
    }
    // Calcula el nivel inicial del usuario en función de sus referidos y puntos
    private function calculateInitialLevel($directCount, $userId)
    {
        $level = 0;
        $totalPoints = 0;

        $points = UserPoint::where('user_id', $userId)->where('status', 1)->first();
        if ($points) {
            $totalPoints = $points->left_pts + $points->right_pts;
        }

        if ($directCount >= 6 && $totalPoints >= 664) {
            $level = 11;
        } elseif ($directCount >= 5 && $totalPoints >= 432) {
            $level = 10;
        } elseif ($directCount >= 5 && $totalPoints >= 280) {
            $level = 9;
        } elseif ($directCount >= 4 && $totalPoints >= 184) {
            $level = 8;
        } elseif ($directCount >= 4 && $totalPoints >= 96) {
            $level = 7;
        } elseif ($directCount >= 3 && $totalPoints >= 72) {
            $level = 6;
        } elseif ($directCount >= 3 && $totalPoints >= 48) {
            $level = 5;
        } elseif ($directCount >= 3 && $totalPoints >= 32) {
            $level = 4;
        } elseif ($directCount >= 2 && $totalPoints >= 24) {
            $level = 3;
        } elseif ($directCount >= 2 && $totalPoints >= 16) {
            $level = 2;
        } elseif ($directCount >= 2 && $totalPoints >= 8) {
            $level = 1;
        }
        return $level;
    }

    public function render()
    {
        return view('livewire.admin.update-rank');
    }
}
