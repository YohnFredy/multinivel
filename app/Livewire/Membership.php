<?php

namespace App\Livewire;

use App\Livewire\Forms\MembershipForm;
use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use App\Models\Relationship;
use App\Models\User;
use App\Models\UserCount;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Membership extends Component
{
    public MembershipForm $form;

    public bool $confirmingRegistration = false;
    public string $sponsor = 'master', $position = 'right';
    public $countries = [], $departments = [], $cities = [];
   
    #[Validate()]
    public $selectedCountry = '', $selectedDepartment = '', $selectedCity = '',  $addCity = '';

    public function rules()
    {
        return [
            'selectedCountry' => 'required',
            'selectedDepartment' => 'required',
            'selectedCity' => Rule::requiredIf(empty($this->addCity)),
            'addCity' => Rule::requiredIf(empty($this->selectedCity)),  
        ];
    }

    public function mount($sponsor, $position)
    {
        $this->form->sponsor = $this->sponsor = $sponsor;
        $this->form->position = $this->position = $position;
        $this->countries = Country::all();
    }

    public function updatedSelectedCountry($countryId)
    {
        $this->reset(['departments', 'selectedDepartment', 'cities', 'selectedCity', 'addCity']);
        $this->departments = Department::where('country_id', $countryId)->get();
        $this->form->countryId = $countryId;
        $this->form->reset('departmentId', 'cityId', 'addCity');
    }

    public function updatedSelectedDepartment($departmentId)
    {
        $this->reset(['cities', 'selectedCity', 'addCity']);
        $this->cities = City::where('department_id', $departmentId)->get();
        $this->form->departmentId = $departmentId;
        $this->form->reset('cityId', 'addCity');
    }

    public function updatedSelectedCity($cityId)
    {
        $this->reset('addCity');
        $this->form->cityId = $cityId;
        $this->form->reset('addCity');
    }

    public function updatedAddCity()
    {
        $this->form->addCity = $this->addCity;
        $this->form->reset('cityId');
    }

    public function updatedConfirmingRegistration()
    {
        $this->form->reset();
        $this->reset(['states', 'cities', 'selectedCountry', 'selectedDepartment', 'selectedCity', 'addCity']);
        $this->form->sponsor = $this->sponsor;
        $this->form->position = $this->position;
    }

    public function save()
    {
        $this->form->username = preg_replace('/\s+/', '', $this->form->username);
        $this->validate();
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
