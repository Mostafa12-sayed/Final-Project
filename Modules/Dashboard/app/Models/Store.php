<?php

namespace Modules\Dashboard\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\app\Models\Admin;
use Modules\Dashboard\Database\factories\StoreFactory;

use Modules\Website\app\Models\Product;

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
        return $this->hasOne(Admin::class ,'store_id' , 'id');
    }


    public function products()
    {
        return $this->hasMany(Product::class );
    }

}
