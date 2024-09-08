<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;
    protected $fillable = ['sale_income', 'commission_income', 'binary_points_for_payment', 'pool1_percentage', 'pts_value', 'status'];

    const STATUS_ACTIVE = 1;
    const STATUS_PROCESS = 2;
    const STATUS_INACTIVE = 3;
}
