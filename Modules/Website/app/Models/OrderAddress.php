<?php

namespace Modules\Website\app\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'type',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'street_addresses',
        'country',
        'city',
        'postal_code',
        'state',
    ];
}
