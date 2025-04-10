<?php

namespace Modules\Website\app\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Website\Database\factories\ProductFactory;



class Product extends Model
{
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

}
