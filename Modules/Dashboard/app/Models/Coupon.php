<?php

namespace Modules\Dashboard\app\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Dashboard\app\Models\Admin;

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
        'user_id',
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

    public function user()
    {
        return $this->belongsTo(Admin::class);

    }
}
