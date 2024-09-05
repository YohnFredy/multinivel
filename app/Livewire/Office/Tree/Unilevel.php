<?php

namespace App\Livewire\Office\Tree;

use App\Models\Relationship;
use App\Models\User;
use App\Models\UserCount;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Unilevel extends Component
{
    public $tree;
    public $currentUser;
    public $secondaryUserId;
    public $primaryUserId;

    const MAX_TREE_LEVEL = 4;

    public function mount()
    {
        $this->currentUser = Auth::user();
        $this->primaryUserId = $this->secondaryUserId = $this->currentUser->id;
    }

    private function buildTree($relationship, $level = 0)
    {
        $userCount = UserCount::where('user_id', $relationship->user_id,)->first();

        $total_direct = $userCount->total_direct ?? 0;
        $total_unilevel = $userCount->total_unilevel ?? 0;

        $branch = [
            'level' => $level,
            'id' => $relationship->user_id,
            'username' => $relationship->user->username,
            'children' => [],
            'total_direct' => $total_direct,
            'total_unilevel' =>  $total_unilevel,
        ];

        if ($level < self::MAX_TREE_LEVEL) {
            $branch['children'] = Relationship::where('parent_id', $relationship->user_id)
                ->get()
                ->map(fn($child) => $this->buildTree($child, $level + 1))
                ->toArray();
        }
        return $branch;
    }

    public function show(User $user)
    {
        $this->currentUser = $user;
        if ($this->primaryUserId !== $this->currentUser->id) {
            if ($this->currentUser->id == $this->secondaryUserId) {
                $this->currentUser = User::find($this->currentUser->relationship->parent_id);
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
        return view('livewire.office.tree.unilevel');
    }
}
