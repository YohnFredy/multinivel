<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sex',
        'birthdate',
        'phone',
        'country_id',
        'state_id',
        'city_id',
        'city',
        'address',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
