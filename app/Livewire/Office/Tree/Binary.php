<?php

namespace App\Livewire\Office\Tree;

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

        $personal_pts = UserPoint::where('user_id', $relationship->user_id)->first();
        $binaryPoints = $this->calculateBinaryPoints($relationship->user_id);

        $branch = [
            'level' => $level,
            'id' => $relationship->user_id,
            'username' => $relationship->user->id,
            'children' => [],
            'position' => $relationship->position,
            'left' => $totalBinary['left'],
            'right' => $totalBinary['right'],
            'personal_pts' => $personal_pts->personal_pts ?? 0,
            'leftPts' => $binaryPoints['left'],
            'rightPts' => $binaryPoints['right'],
        ];

        if ($level < self::MAX_TREE_LEVEL) {
            $branch['children'] = $this->getChildrenBranches($relationship->user_id, $level);
        }

        return $branch;
    }

    private function calculateBinaryPoints(int $userId): array
    {
        $points = ['left' => 0, 'right' => 0];
        $binaryDirects = Relationship::where('binary_parent_id', $userId)->get();

        foreach ($binaryDirects as $direct) {
            $position = $direct->position;
            if (in_array($position, ['left', 'right'])) {
                $userPoint = UserPoint::firstWhere('user_id', $direct->user_id);
                $points[$position] = $userPoint ? $userPoint->binary_pts + $userPoint->personal_pts : 0;
            }
        }

        return $points;
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
