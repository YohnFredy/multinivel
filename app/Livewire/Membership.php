<?php

namespace App\Livewire;

use App\Livewire\Forms\MembershipForm;
use App\Models\Country;
use App\Models\Relationship;
use App\Models\State;
use App\Models\User;
use App\Models\UserCount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Membership extends Component
{
    public MembershipForm $form;

    public bool $confirmingRegistration = false;
    public string $sponsor = 'master', $position = 'right';
    public $countries,  $states = [], $country_id = '';

    public function mount($sponsor, $position)
    {
        $this->form->sponsor = $this->sponsor = $sponsor;
        $this->form->position = $this->position = $position;
        $this->countries = Country::all();
    }

    public function updatedCountryId($value)
    {
        $this->states = State::where('country_id', $value)->get();
        $this->form->country_id = $value;
    }

    public function updatedConfirmingRegistration()
    {
        $this->form->reset();
        $this->form->sponsor = $this->sponsor;
        $this->form->position = $this->position;
    }

    public function save()
    {

        $userId = $this->form->store();
        /* $parent = User::where('username', $this->form->sponsor)->firstOrFail(); */
        $parent =  User::where('username', $this->form->sponsor)->first();

        $binaryParentId = $this->findBinarySponsor($parent->id, $this->form->position);
        $relationship = $this->createRelationship($userId, $parent->id, $binaryParentId, $this->form->position);

        $this->updateUserCounts($relationship, $parent->id);


        $this->confirmingRegistration = true;
    }

    private function findBinarySponsor(int $parentId, string $position): int
    {
        while (true) {
            $relationship = Relationship::where('binary_parent_id', $parentId)
                ->where('position', $position)
                ->first();

            if (!$relationship) {
                return $parentId;
            }

            $parentId = $relationship->user_id;
            $this->incrementBinaryCount($parentId, $position);
        }
    }

    private function createRelationship(int $userId, int $parentId, int $binaryParentId, string $position): Relationship
    {
        return Relationship::create([
            'user_id' => $userId,
            'parent_id' => $parentId,
            'binary_parent_id' => $binaryParentId,
            'position' => $position,
        ]);
    }

    private function updateUserCounts(Relationship $relationship, int $parentId)
    {
        $this->incrementUnilevelCounts($relationship->parent_id);
        $this->incrementAscendingUnilevelCounts($relationship->parent_id);
        $this->incrementAscendingBinaryCounts($parentId, $relationship->position);
    }

    private function incrementBinaryCount(int $userId, string $position)
    {
        $userCount = UserCount::firstOrCreate(
            ['user_id' => $userId],
            ['total_binary_left' => 0, 'total_binary_right' => 0]
        );

        $userCount->increment($position === 'left' ? 'total_binary_left' : 'total_binary_right');
    }

    private function incrementUnilevelCounts(int $userId)
    {
        $userCount = UserCount::firstOrCreate(
            ['user_id' => $userId],
            ['total_direct' => 0, 'total_unilevel' => 0]
        );

        $userCount->increment('total_direct');
        $userCount->increment('total_unilevel');
    }

    private function incrementAscendingUnilevelCounts(int $userId)
    {
        while ($userId > 1) {
            $relationship = Relationship::where('user_id', $userId)->first();
            if (!$relationship) {
                break;
            }

            $userId = $relationship->parent_id;
            UserCount::where('user_id', $userId)->increment('total_unilevel');
        }
    }

    private function incrementAscendingBinaryCounts(int $userId, string $position)
    {
        while (true) {
            $relationship = Relationship::where('user_id', $userId)->first();
            if (!$relationship) {
                break;
            }

            $this->incrementBinaryCount($userId, $position);

            $userId = $relationship->binary_parent_id;
            $position = $relationship->position;
        }
    }

    public function redirectToHome()
    {
        return redirect('/');
    }

    #[Layout('components.layouts.base')]
    public function render()
    {
        return view('livewire.membership');
    }
}
