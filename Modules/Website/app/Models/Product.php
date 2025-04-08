<?php

namespace Modules\Website\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Website\Database\factories\ProductFactory;

class Product extends Model
{
    use HasFactory;
    protected static function newFactory()
    {
        return ProductFactory::new();
    }

    // /**
    //  * The attributes that are mass assignable.
    //  */
    // protected $fillable = [];

    // protected static function newFactory(): ProductFactory
    // {
    //     //return ProductFactory::new();
    // }
    protected $fillable = [
        // 'store_id',
        'category_id',
        'name',
        'description',
        // 'slug',
        'brand',
        'weight',
        'price',
        'discount',
        'gallery',
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
        'gallery' => 'json',
        'options' => 'json',
        'is_new' => 'boolean',
    ];

    public function store()
    {
        // return $this->belongsTo(Store::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
