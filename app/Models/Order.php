<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['public_order_number', 'user_id', 'contact', 'phone', 'status', 'envio_type', 'discount', 'shipping_cost', 'total', 'total_pts', 'country_id', 'state_id', 'city_id', 'addCity', 'address', 'reference', 'payment_id'];

    const STATUS_PROCESSING = 'processing';
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';
    const STATUS_FAILED = 'failed';


    public function getRouteKeyName()
    {
        return 'public_order_number';
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // Método para actualizar el estado de la orden
    public function updateStatus($status)
    {
        $this->status = $status;
        $this->save();
    }

    public function updateStatusAndPayment($status, $paymentId = null)
    {
        $this->status = $status;
        $this->payment_id = $paymentId;
        
        $this->save();
    }
}
