<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Metadata\Uses;

class UserCount extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total_direct', 'total_unilevel', 'total_binary_left', 'total_binary_right'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    
}
