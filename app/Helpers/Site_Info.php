<?php

namespace App\Helpers;

use App\Models\SiteInfo;
use Modules\Dashboard\app\Models\Category;

class Site_Info
{
    public static function site_info()
    {
        $site_info=SiteInfo::first();

        return $site_info;
    }
    public static function categories()
    {
        $categories=Category::take(6)->get();

        return $categories;
    }


}