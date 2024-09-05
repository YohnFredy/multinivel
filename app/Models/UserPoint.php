<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPoint extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'personal_pts', 'binary_pts', 'status'];

    const STATUS_ACTIVE = 1;
    const STATUS_PROCESS = 2;
    const STATUS_INACTIVE = 3;
}
