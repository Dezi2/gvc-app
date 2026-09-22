<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'status',
        'payment_method',
        'payment_reference',
        'payment_status',
        'full_name',
        'phone',
        'email',
        'delivery_address',
        'city',
        'state',
        'notes',
    ];

    // An order belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // An order has many items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}