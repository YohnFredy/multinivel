<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    use HasFactory;
    protected $fillable=['user_id', 'level', 'status'];

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;
   

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function commission()
    {
        return $this->hasOne(Commission::class, 'user_id', 'user_id');
    }
}
