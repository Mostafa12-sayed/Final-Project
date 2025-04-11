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

}
