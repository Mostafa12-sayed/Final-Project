<?php

namespace Modules\Dashboard\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Dashboard\Database\factories\CodeFactory;

class Code extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): CodeFactory
    {
        // return CodeFactory::new();
    }
}
