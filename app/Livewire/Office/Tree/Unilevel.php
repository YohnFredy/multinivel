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

    public function mount()
    {
        $this->currentUser = Auth::user();
        $this->primaryUserId = $this->currentUser->id;
        $this->secondaryUserId = $this->currentUser->id;
    }

    private function buildTree($relationship, $level = 0)
    {
        $maxLevel = 4;
        $userCount = UserCount::where('user_id', $relationship->user_id,)->first();

        $total_direct = 0;
        $total_unilevel = 0;

        if ($userCount) {
            $total_direct = $userCount->total_direct;
            $total_unilevel = $userCount->total_unilevel;
        }

        $branch = [
            'level' => $level,
            'id' => $relationship->user_id,
            'username' => $relationship->user->username,
            'children' => [],
            'total_direct' => $total_direct,
            'total_unilevel' =>  $total_unilevel,
        ];

        if ($level < $maxLevel) {
            $children = Relationship::where('parent_id', $relationship->user_id)->get();
            foreach ($children as $child) {
                $branch['children'][] = $this->buildTree($child, $level + 1);
            }
        }
        return $branch;
    }

    public function show(User $user)
    {
        $this->currentUser = $user;

        if ($this->primaryUserId !== $this->currentUser->id) {
            if ($this->currentUser->id == $this->secondaryUserId) {
                $relationship = $this->currentUser->relationship;
                $this->currentUser = User::find($relationship->parent_id);
                $this->secondaryUserId = $this->currentUser->id;
            } else {
                $this->secondaryUserId = $this->currentUser->id;
            }
        }
    }

    #[Layout('components.layouts.office')]
    public function render()
    {
        $relationship = $this->currentUser->relationship;
        $this->tree = $this->buildTree($relationship);
        return view('livewire.office.tree.unilevel');
    }
}
