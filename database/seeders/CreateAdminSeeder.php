<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\Dashboard\app\Models\Admin;
use Modules\Dashboard\app\Models\Permission;
use Modules\Dashboard\app\Models\Role;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();
        $admin=Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'username' => 'admin',
            'type' => 'admin',
            'status' => 'active',
            'is_verified' => true,
            'created_by' => 'system',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $role =Role::create([
            'name' => 'Super Admin',
            'description' => 'Super Admin Role',
            'display_name' => 'Super Admin',
            'created_at' => now(),
            'updated_at' => now(),
            'role_status' => 'on',
        ]);
        $admin->role_id =$role->id; // Assign the role to the admin

            $admin->roles()->attach($role->id); // Works if the roles() relationship is defined correctly


            if ($role) {
                // Get all permission IDs
                $allPermissions = Permission::pluck('id')->toArray();
                $role->permissions()->sync($allPermissions);
            }
        DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            echo 'Exception: ', $e->getMessage(), "\n";
        }

    }
}
