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

    #[Validate('required|min:5|unique:users,identification_card')]
    public string $identificationCard = '';

    #[Validate('required|min:3|max:20|unique:users,username')]
    public string $username = '';

    #[Validate('required|unique:users,email')]
    public string $email = '';

    #[Validate('required')]
    public string $sex = '', $birthdate = '', $phone = '';

    #[Validate('required')]
    public ?int $country = null, $state = null;

    #[Validate('required_without:addCity', message: 'El campo ciudad es requerido')]
    public ?int $city = null;

    #[Validate('required_without:city', message: 'El campo agregar ciudad es requerido')]
    public ?string $addCity = null;

    public string $address = '';

    #[Validate('required')]
    #[Validate('exists:users,username', message: 'El nombre de usuario no está registrado en nuestra base de datos')]
    public string $sponsor = '';

    #[Validate('required|in:left,right')]
    public string $position = '';

    #[Validate('required|string|min:8')]
    public $password = '';

    #[Validate('required|same:password')]
    public $password_confirmation = '';

    #[Validate('accepted')]
    public bool $terms = false;

    public function store()
    {
        $this->username = preg_replace('/\s+/', '', $this->username);
        $this->validate();

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
            'country_id' => $this->country,
            'state_id' => $this->state,
            'city_id' => $this->city,
            'city' => $this->addCity,
            'address' => $this->address,
        ]);

        return $user->id;
    }
}
