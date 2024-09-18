<?php

namespace App\Livewire\Admin;

use App\Models\Commission;
use App\Models\Rank;
use App\Models\Relationship;
use App\Models\UserPoint;
use Livewire\Component;

class UpdateRank extends Component
{
    public function updateRanks()
    {
        Commission::where('user_id', '<', 32)->where('status', 1)
            ->orderByDesc('user_id')
            ->chunk(100, function ($commissions) {
                foreach ($commissions as $commission) {
                    $this->processUserRank($commission->user_id);
                }
            });
    }

    private function processUserRank($userId)
    {
        $directUsers = Relationship::where('parent_id', $userId)->get();
        $directUsersCount = $directUsers->count();
        $initialRankLevel = $this->getInitialRankLevel($directUsersCount, $userId);

        $rankLevel = ($initialRankLevel > 1)
            ? $this->determineRankLevel($directUsers, $initialRankLevel, $directUsersCount)
            : 1;

        Rank::updateOrCreate(
            ['user_id' => $userId, 'status' => 1],
            ['level' => $rankLevel]
        );
    }

    private function determineRankLevel($directUsers, $currentLevel, $directUsersCount)
    {
        $rules = $this->getRankRulesForLevel($currentLevel);
        $finalRank = 0;

        while ($finalRank == 0) {
            $remainingUsersCount = $directUsersCount;
            $tempRules = $rules;

            foreach ($directUsers as $user) {
                if ($remainingUsersCount < $tempRules['total']['quantity']) {
                    break;
                }

                $this->processDirectUser($user, $tempRules, $currentLevel);
                $remainingUsersCount--;
            }

            if ($tempRules['total']['quantity'] <= 0) {
                $finalRank = $currentLevel;
            } elseif ($currentLevel >= 3) {
                $currentLevel--;
                $rules = $this->getRankRulesForLevel($currentLevel);
            } else {
                $finalRank = $currentLevel - 1;
            }
        }

        return $finalRank;
    }

    private function processDirectUser($user, &$rules, $currentLevel)
    {
        $userRank = Rank::where('user_id', $user->user_id)->where('status', 1)->first();

        if ($userRank) {
            $this->processExistingRank($userRank, $rules, $currentLevel, $user->user_id);
        } else {
            $this->processNewRank($rules, $currentLevel, $user->user_id);
        }
    }

    private function processExistingRank($userRank, &$rules, $currentLevel, $userId)
    {
        foreach ($rules as $rankLevel => $rule) {
            if (is_numeric($rankLevel) && $userRank->level >= $rankLevel) {
                $this->decrementRuleQuantity($rules, $rankLevel);
                break;
            } elseif (is_numeric($rankLevel)) {
                $isEligible = $this->checkUserEligibility($userId, $rankLevel, $rule['minPoints']);
                if ($isEligible == 0) {
                    $this->decrementRuleQuantity($rules, $rankLevel);
                    break;
                }
            }
        }
    }

    private function processNewRank(&$rules, $currentLevel, $userId)
    {
        foreach ($rules as $rankLevel => $rule) {
            if (is_numeric($rankLevel)) {
                $isEligible = $this->checkUserEligibility($userId, $rankLevel, $rule['minPoints']);
                if ($isEligible == 0) {
                    $this->decrementRuleQuantity($rules, $rankLevel);
                    break;
                }
            }
        }
    }

    private function decrementRuleQuantity(&$rules, $rankLevel)
    {
        $rules[$rankLevel]['quantity']--;
        $rules['total']['quantity']--;
        if ($rules[$rankLevel]['quantity'] == 0) {
            unset($rules[$rankLevel]);
        }
    }

    private function checkUserEligibility($userId, $requiredRankLevel, $minPoints)
    {
        $isEligible = 1;
        $potentialUsers = [];
        $userPoints = UserPoint::where('user_id', $userId)->where('status', 1)->first();

        if ($userPoints && ($userPoints->left_pts + $userPoints->right_pts) >= $minPoints) {
            $relatedUsers = Relationship::where('parent_id', $userId)->get();
            foreach ($relatedUsers as $relatedUser) {
                $relatedUserRank = Rank::where('user_id', $relatedUser->user_id)->where('status', 1)->first();

                if ($relatedUserRank && $relatedUserRank->level >= $requiredRankLevel) {
                    return 0;
                } else {
                    $potentialUsers[] = $relatedUser->user_id;
                }
            }

            if (count($potentialUsers) > 0) {
                foreach ($potentialUsers as $potentialUserId) {
                    $isEligible = $this->checkUserEligibility($potentialUserId, $requiredRankLevel, $minPoints);
                    if ($isEligible == 0) {
                        return 0;
                    }
                }
            }
        }

        return $isEligible;
    }

    private function getRankRulesForLevel($level)
    {
        $rankRules = [];

        switch ($level) {
            case 14:
                $rankRules = [13 => ['minPoints' => 85860, 'quantity' => 1], 12 => ['minPoints' => 43300, 'quantity' => 1], 11 => ['minPoints' => 21840, 'quantity' => 1], 10 => ['minPoints' => 10920, 'quantity' => 1], 9 => ['minPoints' => 5555, 'quantity' => 1], 8 => ['minPoints' => 2830, 'quantity' => 1], 7 => ['minPoints' => 1415, 'quantity' => 1], 'total' => ['quantity' => 7]];
                break;
            case 13:
                $rankRules = [12 => ['minPoints' => 43300, 'quantity' => 1], 11 => ['minPoints' => 21840, 'quantity' => 1], 10 => ['minPoints' => 10920, 'quantity' => 1], 9 => ['minPoints' => 5555, 'quantity' => 1], 8 => ['minPoints' => 2830, 'quantity' => 1], 7 => ['minPoints' => 1415, 'quantity' => 1], 'total' => ['quantity' => 6]];
                break;
            case 12:
                $rankRules = [11 => ['minPoints' => 21840, 'quantity' => 1], 10 => ['minPoints' => 10920, 'quantity' => 1], 9 => ['minPoints' => 5555, 'quantity' => 1], 8 => ['minPoints' => 2830, 'quantity' => 1], 7 => ['minPoints' => 1415, 'quantity' => 1], 6 => ['minPoints' => 740, 'quantity' => 1], 'total' => ['quantity' => 6]];
                break;
            case 11:
                $rankRules = [10 => ['minPoints' => 10920, 'quantity' => 1], 9 => ['minPoints' => 5555, 'quantity' => 1], 8 => ['minPoints' => 2830, 'quantity' => 1], 7 => ['minPoints' => 1415, 'quantity' => 1], 6 => ['minPoints' => 740, 'quantity' => 1], 5 => ['minPoints' => 380, 'quantity' => 1], 'total' => ['quantity' => 6]];
                break;
            case 10:
                $rankRules = [9 => ['minPoints' => 5555, 'quantity' => 1], 8 => ['minPoints' => 2830, 'quantity' => 1], 7 => ['minPoints' => 1415, 'quantity' => 1], 6 => ['minPoints' => 740, 'quantity' => 1], 5 => ['minPoints' => 380, 'quantity' => 1], 'total' => ['quantity' => 5]];
                break;
            case 9:
                $rankRules = [8 => ['minPoints' => 2830, 'quantity' => 1], 7 => ['minPoints' => 1415, 'quantity' => 1], 6 => ['minPoints' => 740, 'quantity' => 1], 5 => ['minPoints' => 380, 'quantity' => 1], 4 => ['minPoints' => 190, 'quantity' => 1], 'total' => ['quantity' => 5]];
                break;
            case 8:
                $rankRules = [7 => ['minPoints' => 1415, 'quantity' => 1], 6 => ['minPoints' => 740, 'quantity' => 1], 5 => ['minPoints' => 380, 'quantity' => 1], 4 => ['minPoints' => 190, 'quantity' => 1], 3 => ['minPoints' => 105, 'quantity' => 1], 'total' => ['quantity' => 5]];
                break;
            case 7:
                $rankRules = [6 => ['minPoints' => 740, 'quantity' => 1], 5 => ['minPoints' => 380, 'quantity' => 1], 4 => ['minPoints' => 190, 'quantity' => 1], 3 => ['minPoints' => 105, 'quantity' => 1], 'total' => ['quantity' => 4]];
                break;
            case 6:
                $rankRules = [5 => ['minPoints' => 380, 'quantity' => 1], 4 => ['minPoints' => 190, 'quantity' => 1], 3 => ['minPoints' => 105, 'quantity' => 1], 2 => ['minPoints' => 65, 'quantity' => 1], 'total' => ['quantity' => 4]];
                break;
            case 5:
                $rankRules = [4 => ['minPoints' => 190, 'quantity' => 1], 3 => ['minPoints' => 105, 'quantity' => 1], 2 => ['minPoints' => 65, 'quantity' => 1], 1 => ['minPoints' => 20, 'quantity' => 1], 'total' => ['quantity' => 4]];
                break;
            case 4:
                $rankRules = [3 => ['minPoints' => 105, 'quantity' => 1], 2 => ['minPoints' => 65, 'quantity' => 1], 1 => ['minPoints' => 20, 'quantity' => 1], 'total' => ['quantity' => 3]];
                break;
            case 3:
                $rankRules = [2 => ['minPoints' => 65, 'quantity' => 1], 1 => ['minPoints' => 20, 'quantity' => 2], 'total' => ['quantity' => 3]];
                break;
            case 2:
                $rankRules = [1 => ['minPoints' => 20, 'quantity' => 3], 'total' => ['quantity' => 3]];
                break;
        }
        return $rankRules;
    }
    private function getInitialRankLevel($directUsersCount, $userId)
    {
        $userPoints = UserPoint::where('user_id', $userId)->where('status', 1)->first();
        $totalPoints = $userPoints ? ($userPoints->left_pts + $userPoints->right_pts) : 0;

        $rankLevels = [
            [14, 7, 171720],
            [13, 6, 85860],
            [12, 6, 43300],
            [11, 6, 21840],
            [10, 5, 10920],
            [9, 5, 5555],
            [8, 5, 2830],
            [7, 4, 1415],
            [6, 4, 740],
            [5, 4, 380],
            [4, 3, 190],
            [3, 3, 105],
            [2, 3, 65],
        ];

        foreach ($rankLevels as [$level, $requiredUsers, $requiredPoints]) {
            if ($directUsersCount >= $requiredUsers && $totalPoints >= $requiredPoints) {
                return $level;
            }
        }

        return 1;
    }


    public function render()
    {
        return view('livewire.admin.update-rank');
    }
}
