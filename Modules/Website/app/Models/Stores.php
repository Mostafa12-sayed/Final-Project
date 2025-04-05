<?php

namespace Modules\Website\app\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Website\Database\factories\StoresFactory;

class Stores extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'slug',
        'description'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected static function newFactory(): StoresFactory
    {
        //return StoresFactory::new();
    }
}
