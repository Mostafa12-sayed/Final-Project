<?php

namespace Modules\Dashboard\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\AdminFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // هذا مهم
use Modules\Website\app\Models\Stores;
class Admin extends Authenticatable
{
    use HasFactory;
    
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
        return $this->hasOne(Stores::class);
    }
}
