<?php

namespace Modules\Website\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Modules\Website\Database\factories\ProductFactory;

class Product extends Model
{
    use HasFactory ,SoftDeletes;
    use Searchable;

    protected static function newFactory(): ProductFactory
    {
        return ProductFactory::new();
    }

    protected $fillable = [

        'category_id',
        'name',
        'description',
        'slug',
        'brand',
        'weight',
        'price',
        'discount',
        'gallery',
        'image',
        'code',
        'tax',
        'rating',
        'is_new',
        'stock',
        'quantity',
        'options',
        'status',
        'slug',
        'image',
        'expiry_date'
    ];

    protected $casts = [
        'gallery' => 'array',
        'options' => 'json',
        'is_new' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function store()
    {
        return $this->belongsTo(Stores::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();

        return [
            'name' => $this->name,
        ];;
    }

    public function getDiscountedPriceAttribute()
    {
        return $this->price - ($this->price * $this->discount / 100); // Example for percentage discount
    }

    public function getTrendingItemsAttribute()
    {
        $quantity = (int) ($this->quantity ?? 0);
        $stock = (int) ($this->stock ?? 0);
        $rating = ($this->rating ?? 0);
        $sold = $quantity - $stock;
        $daysOld = now()->diffInHours($this->created_at);
        $score = ($sold * 2) + ($rating * 3) - ($daysOld * 0.5);

        return $score;
    }

    public static function formatStoreNames($stores)
    {
        if (empty($stores)) {
            return 'Unknown Store';
        }

        return collect($stores)->pluck('name')->filter()->join(', ');
    }
}