<?php

namespace Modules\Website\app\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Website\Database\factories\ProductFactory;
use Laravel\Scout\Searchable;


class Product extends Model
{
    use Searchable;


    use HasFactory ,SoftDeletes ;
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
        'image'
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
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }


    
    public function toSearchableArray(): array
    {
        // Eager load relationships
        $this->load('category', 'reviews'); 

        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'category_name' => $this->category ? $this->category->name : null, // Ensure category is available
            'reviews' => $this->reviews->pluck('content'), // Example: getting review content as an array
        ];
    }
    public function getDiscountedPriceAttribute()
    {
        return $this->price - ($this->price * $this->discount / 100); // Example for percentage discount
    }
    
    public function getTrendingItemsAttribute()
    {
        $quantity = (int)($this->quantity ?? 0);
        $stock = (int)($this->stock ?? 0);
        $rating = ($this->rating ?? 0);  
        $sold = $quantity - $stock;
        $daysOld = now()->diffInHours($this->created_at);
        // Calculate the trending score
        $score = ($sold * 2) + ($rating * 3) - ($daysOld * 0.5);
    
        return $score; 
    }
}
