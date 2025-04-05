<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Dashboard\app\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin2@example.com',
            'password' => Hash::make('admin123'),
            'username' => 'admin',
            'type' => 'admin',
            'status' => 'active',
            'is_verified' => true,
            'created_by' => 'system',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
