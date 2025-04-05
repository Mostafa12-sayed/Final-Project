<?php

namespace Modules\Website\app\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Website\Database\factories\AddressesFactory;

class Addresses extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'city',
        'state',
        'zip_code',
    ];
    
    protected static function newFactory(): AddressesFactory
    {
        //return AddressesFactory::new();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
