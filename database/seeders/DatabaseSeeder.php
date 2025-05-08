<?php

namespace Database\Seeders;

use App\Models\SiteInfo;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\Dashboard\Database\Seeders\PermissionSeeder;
use Modules\Website\database\seeders\WebsiteDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
        //    PermissionSeeder::class,
        //    CreateAdminSeeder::class,
            WebsiteDatabaseSeeder::class,

        ]);
    //    SiteInfo::factory()->count(1)->create();

    }
}
