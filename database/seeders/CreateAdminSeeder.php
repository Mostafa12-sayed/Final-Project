<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\Dashboard\app\Models\Admin;

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
