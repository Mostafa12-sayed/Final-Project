<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\Dashboard\app\Models\Coupon;
use Modules\Website\app\Models\Addresses;
use Modules\Website\app\Models\Stores;
use Modules\Website\app\Models\Review;
use Modules\Website\app\Models\Wishlist;
use Illuminate\Support\Str;
class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'phone',
        'email',
        'profile_image',
        'image_url',
        'password',
        'user_type',
        'google_id',
        'facebook_id',
        'twitter_id',
        'email_verified_at',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function stores()
    {
        return $this->hasOne(Stores::class);
    }

    public function addresses()
    {
        return $this->hasOne(Addresses::class);
    }
    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }



    public function getImageUrlAttribute()
    {
        if (!$this->profile_image) {
            return asset('assets/img/account/04.jpg');
        }
        if (Str::startsWith($this->profile_image, ['http', 'https'])) {
            return $this->profile_image;
        }

        return asset('assets/img/account/'.$this->profile_image);
    }



}
