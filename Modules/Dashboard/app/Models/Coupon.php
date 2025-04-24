<?php

namespace Modules\Dashboard\app\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons_tabel'; // Match your migration

    protected $fillable = [
        'name',
        'description',
        'discount',
        'code',
        'limit',
        'expiry_date',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'expiry_date' => 'datetime',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'coupons_users', 'coupon_id', 'user_id')
            ->withTimestamps();
    }

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(Admin::class);

    }
}
