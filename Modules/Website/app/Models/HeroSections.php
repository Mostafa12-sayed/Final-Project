<?php

namespace Modules\Website\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Website\database\factories\HeroSectionyFactory;

class HeroSections extends Model
{
    protected $table = 'hero_section';

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];

    protected static function newFactory(): HeroSectionyFactory
    {
        return HeroSectionyFactory::new();
    }
}
