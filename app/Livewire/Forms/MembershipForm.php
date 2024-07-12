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
    public $name = '';

    #[Validate('required|min:3')]
    public $last_name = '';

    #[Validate('required|min:5|unique:users,identification_card')]
    public $identification_card = '';

    #[Validate('required|min:3|max:20|unique:users,username')]
    public $username = '';

    #[Validate('required|unique:users,email')]
    public $email = '';

    #[Validate('required')]
    public $sex = '';

    #[Validate('required')]
    public $birthdate = '';

    public $country_id= '';
    public $state_id = '';
    public $city = '';
    public $address = '';

    #[Validate('required')]
    public $phone = '';

    #[Validate('required')]
    #[Validate('exists:users,username', message: 'El nombre de usuario no está registrado en nuestra base de datos')]
    public $sponsor = '';

    #[Validate('required|in:left,right')]
    public $position = '';

    #[Validate('required|string|min:8|confirmed',)]
    public $password = '';

    #[Validate('required|string|min:8')]
    public $password_confirmation = '';

    #[Validate('accepted')]
    public $terms;

    public function store()
    {
        $this->username = preg_replace('/\s+/', '', $this->username);

        $this->validate();

       $user = User::create([
            'name' => $this->name,
            'last_name' => $this->last_name,
            'identification_card' => $this->identification_card,
            'username' => $this->username,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        UserData::create([
            'user_id' => $user->id,
            'sex' => $this->sex,
            'birthdate' => $this->birthdate,
            'phone' => $this->phone,
            'country_id' => $this->country_id,
            'state_id' => $this->state_id,
            'city' => $this->city,
            'address' => $this->address,
        ]);

        return $user->id;
    }
}
