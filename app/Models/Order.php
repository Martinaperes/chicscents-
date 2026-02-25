<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'county',
        'delivery_zone',      // 'cbd' or 'mtaani'
        'delivery_method',    // 'doorstep' or 'pickup'
        'pickup_location',    // Pickup Mtaani agent name
        'mtaani_location',    // Customer's free-text area description
        'payment_method',
        'payment_status',
        'order_status',
        'total_amount',
        'shipping_amount',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
