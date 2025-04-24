<?php

namespace Modules\Website\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Website\Database\factories\ContactUsFactory;

class ContactUs extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'message',
        'subject',
        'reply',
    ];

    protected static function newFactory(): ContactUsFactory
    {
        // return ContactUsFactory::new();
    }
}
