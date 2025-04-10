<?php

namespace Modules\Website\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Website\Database\factories\ReviewFactory;
use App\Models\User;
use Modules\Website\app\Models\Product;

class Review extends Model
{
    use HasFactory;

    protected static function newFactory(): ReviewFactory
    {
        //return ReviewFactory::new();
    }
    protected $fillable = ['user_id', 'product_id', 'rating', 'comment'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


}
