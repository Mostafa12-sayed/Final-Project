<?php
namespace Modules\Website\app\Models;
use Illuminate\Support\Str; 
use Illuminate\Database\Eloquent\Model;

class Stores extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'logo_image',
        'cover_image',
        'status',
        'admin_id'
    ];
    
    protected static function boot()
    {
        parent::boot();
    
        static::creating(function ($store) {
            $store->slug = $store->slug ?? Str::slug($store->name);
        });
    }
}
