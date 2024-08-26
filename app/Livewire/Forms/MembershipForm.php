<?php

namespace App\Livewire\Forms;

use App\Models\User;
use App\Models\UserData;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Form;

class MembershipForm extends Form
{
    #[Validate('required|min:3')]
    public string $name = '', $lastName = '';

    #[Validate('required|min:3|max:20|unique:users,username')]
    public string $username = '';

    #[Validate('required|min:5|unique:users,identification_card')]
    public string $identificationCard = '';

    #[Validate('required|unique:users,email')]
    public string $email = '';

    #[Validate('required')]
    public string $sex = '', $birthdate = '', $phone = '';

    public $countryId, $stateId, $cityId, $addCity = '', $address = '';

    #[Validate('required|string|min:8')]
    public $password = '';

    #[Validate('required|same:password')]
    public $password_confirmation = '';

    #[Validate('required')]
    #[Validate('exists:users,username', message: 'El nombre de usuario no está registrado en nuestra base de datos')]
    public string $sponsor = '';

    #[Validate('required|in:left,right')]
    public string $position = '';

    #[Validate('accepted')]
    public bool $terms = false;

    public function store()
    {
        $user = User::create([
            'name' => $this->name,
            'last_name' => $this->lastName,
            'identification_card' => $this->identificationCard,
            'username' => $this->username,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        UserData::create([
            'user_id' => $user->id,
            'sex' => $this->sex,
            'birthdate' => $this->birthdate,
            'phone' => $this->phone,
            'country_id' => $this->countryId,
            'state_id' => $this->stateId,
            'city_id' => $this->cityId,
            'city' => $this->addCity,
            'address' => $this->address,
        ]);

        return $user->id;
    }
}
