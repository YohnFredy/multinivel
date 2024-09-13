<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'parent_id', 'binary_parent_id', 'position'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userCount(){
        return $this->hasOne(UserCount::class);
    }


    /* public function children()
    {
        return $this->hasMany(Relationship::class, 'parent_id');
    } */
}
