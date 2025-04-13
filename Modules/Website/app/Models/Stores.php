<?php
namespace Modules\Website\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Modules\Website\Database\factories\StoresFactory;

class Stores extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [    
        'admin_id',
        'name',
        'slug',
        'description',
        'logo_image',
        'cover_image',
        'status',
        'commission_rate',
        'is_approved',
    ];
    
    protected static function newFactory(): StoresFactory
    {
        return StoresFactory::new();
    }

    protected static function boot()
    {
        parent::boot();
    
        static::creating(function ($store) {
            $store->slug = $store->slug ?? Str::slug($store->name);
        });
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }   
}