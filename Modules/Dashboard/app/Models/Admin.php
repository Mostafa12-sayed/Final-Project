<?php

namespace Modules\Dashboard\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Dashboard\Database\factories\AdminFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // هذا مهم
use Modules\Dashboard\app\Models\Store;
use Laratrust\Traits\HasRolesAndPermissions;


class Admin extends Authenticatable
{
    use HasFactory,HasRolesAndPermissions ,SoftDeletes;

    Public $guarded = [];

    public $guard = ['admin'];
    protected $table = 'admins';

    /**
     * The attributes that are mass assignable.
    */


    protected static function newFactory(): AdminFactory
    {
        //return AdminFactory::new();
    }

    public function stores()
    {
        return $this->hasOne(Store::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }
}
