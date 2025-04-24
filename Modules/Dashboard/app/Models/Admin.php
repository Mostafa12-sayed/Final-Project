<?php

namespace Modules\Dashboard\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable; // هذا مهم
use Laratrust\Traits\HasRolesAndPermissions;

class Admin extends Authenticatable
{
    use HasFactory,HasRolesAndPermissions ,SoftDeletes;

    public $guarded = [];

    public $guard = ['admin'];

    protected $table = 'admins';

    /**
     * The attributes that are mass assignable.
     */

    //    protected static function booted()
    //    {
    //        static::created(function ($admin) {
    //            $admin->username = 'seller' . $admin->id  . $admin->stores->id;
    //            $admin->save();
    //        });
    //    }

    public function permissions()
    {
        return $this->morphToMany(Permission::class, 'user', 'permission_user');
    }

    public function store()
    {
        return $this->hasOne(Store::class , 'admin_id' , 'id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }

    public function hasPermission($permission, $team = null, $requireAll = false)
    {
        $role = $this->roles()->first();
        if (auth('admin')->user()->id == 1) {
            return true;
        }

        return $this->laratrustUserChecker()->currentUserHasPermission(
            $permission,
            $team,
            $requireAll
        );
    }
}
