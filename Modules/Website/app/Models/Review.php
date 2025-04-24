<?php

namespace Modules\Website\app\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Website\Database\factories\ReviewFactory;

class Review extends Model
{
    use HasFactory;

    protected static function newFactory(): ReviewFactory
    {
        // return ReviewFactory::new();
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
