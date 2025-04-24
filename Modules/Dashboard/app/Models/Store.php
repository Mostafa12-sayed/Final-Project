<?php

namespace Modules\Dashboard\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Website\app\Models\Product;

class Store extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'stores';

    protected $guarded = [];

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
