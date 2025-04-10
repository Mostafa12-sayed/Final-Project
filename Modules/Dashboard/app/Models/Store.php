<?php

namespace Modules\Dashboard\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\StoreFactory;
use Modules\Dashboard\app\Models\Admin;
class Store extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */

     protected $table='stores';
    protected $guarded = [];

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }


    

}
