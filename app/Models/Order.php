<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'contact', 'phone', 'status', 'envio_type','discount','shipping_cost', 'total', 'total_pts', 'country_id', 'state_id', 'city_id', 'addCity', 'address', 'reference'];

    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_SHIPPED = 'shipped';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function state(){
        return $this->belongsTo(State::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    // Método para actualizar el estado de la orden
    public function updateStatus($status)
    {
        $this->status = $status;
        $this->save();
    }
}
