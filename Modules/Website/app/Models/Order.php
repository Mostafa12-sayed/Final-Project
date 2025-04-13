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
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'store_id',
        'number',
        'tracking_number',
        'total',
        'payment_method',
        'status',
        'payment_status',
        'shipping',
        'tax',
        'discount',
    ];

    public function address()
    {
        return $this->hasOne(OrderAddress::class);
    }

    /**
     * Define the relationship with OrderItems.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    /**
     * Get the store associated with the order.
     */
    public function store()
    {
        return $this->belongsTo(Stores::class, 'store_id');
    }

    /**
     * Get the user associated with the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the total price for the order.
     *
     * @return float
     */
    public function getTotalPriceAttribute()
    {
        return $this->total;
    }

    /**
     * Define any custom logic or method you need.
     */
    protected static function newFactory(): OrderFactory
    {
        return OrderFactory::new();
    }
}
