<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'notification_id',
        'type',
        'subject',
        'source',
        'spec_version',
        'time',
        'payment_gateway',
        'payment_id_generated',
        'merchant_id',
        'user_id',
        'total_amount',
        'tip',
        'cardholder_name',
        'franchise',
        'capture_mode',
        'terminal_id',
        'reference',
        'payment_method',
        'taxes',
        'unknown_data',
    ];

    protected $casts = [
        'taxes' => 'array',
    ];
}
