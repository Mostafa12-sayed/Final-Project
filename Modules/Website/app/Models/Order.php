<?php

namespace Modules\Website\app\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'carrier',
        'processing_at',
        'shipped_at',
        'delivered_at',
        'cancelled_at',
        'total',
        'payment_method',
        'status',
        'payment_status',
        'shipping',
        'tax',
        'discount',
    ];

    protected $dates = [
        'processing_at',
        'shipped_at',
        'delivered_at',
        'cancelled_at',
    ];

    public function getTrackingUrlAttribute()
    {
        if (! $this->tracking_number) {
            return null;
        }

        $carriers = [
            'fedex' => 'https://www.fedex.com/fedextrack/?trknbr=',
            'ups' => 'https://www.ups.com/track?tracknum=',
            'usps' => 'https://tools.usps.com/go/TrackConfirmAction?tLabels=',
            'dhl' => 'https://www.dhl.com/en/express/tracking.html?AWB=',
        ];

        return ($carriers[strtolower($this->carrier)] ?? '').$this->tracking_number;
    }

    public function getStatusTimelineAttribute()
    {
        return [
            'pending' => $this->created_at,
            'processing' => $this->processing_at,
            'delivering' => $this->shipped_at,
            'completed' => $this->delivered_at,
            'cancelled' => $this->cancelled_at,
        ];
    }

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

    public function getOrderCountAttribute()
    {
        return $this->items()->count();
    }
}
