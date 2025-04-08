<?php

namespace Modules\Website\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Website\Database\factories\OrderFactory;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id', 
        'tracking_number', 
        'shipping_address', 
        'total_price', 
        'payment_method',
    ];

    /**
     * Define the relationship with OrderItems.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    
    protected static function newFactory(): OrderFactory
    {
        return OrderFactory::new();
    }
}

