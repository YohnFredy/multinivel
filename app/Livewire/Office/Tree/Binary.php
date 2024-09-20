<?php

namespace App\Livewire\Office\Tree;

use App\Models\Commission;
use App\Models\Rank;
use App\Models\Relationship;
use App\Models\User;
use App\Models\UserCount;
use App\Models\UserPoint;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Binary extends Component
{
    public $tree;
    public $currentUser;
    public $secondaryUserId;
    public $primaryUserId;

    const MAX_TREE_LEVEL = 3;

    public function mount()
    {
        $this->currentUser = Auth::user();
        $this->primaryUserId = $this->secondaryUserId = $this->currentUser->id;
    }

    private function buildTree(Relationship $relationship, int $level = 0): array
    {
        $userCount = UserCount::firstWhere('user_id', $relationship->user_id);
        $totalBinary = [
            'left' => $userCount->total_binary_left ?? 0,
            'right' => $userCount->total_binary_right ?? 0
        ];

        $rank = Rank::where('user_id', $relationship->user_id)->where('status', 1)->first();
        $commission = Commission::where('user_id', $relationship->user_id)->first();

        $binary_commission = $commission->binary_commission ?? 0;
        $generational_commission = $commission->generational_commission ?? 0;
        $rank = $rank->level ?? 0;
       

        $userPoint = UserPoint::where('user_id', $relationship->user_id)->first();
        
        $branch = [
            'level' => $level,
            'rank' => $rank,
            'binary_commission' => $binary_commission,
            'generational_commission' => $generational_commission,
            'id' => $relationship->user_id,
            'username' => $relationship->user->username,
            'children' => [],
            'position' => $relationship->position,
            'left' => $totalBinary['left'],
            'right' => $totalBinary['right'],
            'personal_pts' => $userPoint->personal_pts ?? 0,
            'leftPts' => $userPoint->left_pts ?? 0,
            'rightPts' =>$userPoint->right_pts ?? 0,
        ];

        if ($level < self::MAX_TREE_LEVEL) {
            $branch['children'] = $this->getChildrenBranches($relationship->user_id, $level);
        }

        return $branch;
    }

    

    private function getChildrenBranches(int $parentId, int $currentLevel): array
    {
        return Relationship::where('binary_parent_id', $parentId)
            ->get()
            ->map(fn($child) => $this->buildTree($child, $currentLevel + 1))
            ->toArray();
    }

    public function show(User $user)
    {
        $this->currentUser = $user;

        if ($this->primaryUserId !== $this->currentUser->id) {
            if ($this->currentUser->id == $this->secondaryUserId) {
                $this->currentUser = User::find($this->currentUser->relationship->binary_parent_id);
                $this->secondaryUserId = $this->currentUser->id;
            } else {
                $this->secondaryUserId = $this->currentUser->id;
            }
        }
    }

    #[Layout('components.layouts.office')]
    public function render()
    {
        $this->tree = $this->buildTree($this->currentUser->relationship);
        return view('livewire.office.tree.binary');
    }
}
