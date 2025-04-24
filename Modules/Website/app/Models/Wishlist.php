<?php

namespace Modules\Website\app\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Website\Database\factories\WishlistFactory;

class Wishlist extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'product_id',
        // 'created_at',
        // 'updated_at',
    ];

    protected static function newFactory(): WishlistFactory
    {
        // return WishlistFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
