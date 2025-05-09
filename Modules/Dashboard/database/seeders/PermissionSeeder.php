<?php

namespace Modules\Dashboard\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Dashboard\app\Models\Admin;
use Modules\Dashboard\app\Models\Permission;

class PermissionSeeder extends Seeder
{
    public $permissions = [];

    public function initPermissions()
    {
        $perfix = 'dash_';

        $this->permissions = [

            // settings
            ['name' => 'read-settings', 'display_name' => 'Read settings', 'description' => 'عرض الاعدادات   ', 'path' => 'settings'],
            ['name' => 'update-settings', 'display_name' => 'Update settings', 'description' => 'تعديل الاعدادات   ', 'path' => 'settings'],
            ['name' => 'view-dashboard', 'display_name' => 'View dashboard', 'description' => 'عرض لوحة التحكم ', 'path' => 'settings'],

            // admins
            ['name' => 'read-admins', 'display_name' => 'Read Admins', 'description' => 'عرض المشرفين', 'path' => 'admins'],
            ['name' => 'create-admins', 'display_name' => 'Create Admins', 'description' => 'اضافة المشرفين', 'path' => 'admins'],
            ['name' => 'update-admins', 'display_name' => 'Update Admins', 'description' => 'تعديل المشرفين', 'path' => 'admins'],
            ['name' => 'delete-admins', 'display_name' => 'Delete Admins', 'description' => 'حذف المشرفين', 'path' => 'admins'],

            // admins
            ['name' => 'read-sellers', 'display_name' => 'Read sellers', 'description' => 'عرض البائين', 'path' => 'sellers'],
            ['name' => 'create-sellers', 'display_name' => 'Create sellers', 'description' => 'اضافة البائين', 'path' => 'sellers'],
            ['name' => 'update-sellers', 'display_name' => 'Update sellers', 'description' => 'تعديل البائين', 'path' => 'sellers'],
            ['name' => 'delete-sellers', 'display_name' => 'Delete sellers', 'description' => 'حذف البائين', 'path' => 'sellers'],

            // orders
            ['name' => 'read-orders', 'display_name' => 'Read orders', 'description' => 'عرض البائين', 'path' => 'orders'],
            ['name' => 'create-orders', 'display_name' => 'Create orders', 'description' => 'اضافة البائين', 'path' => 'orders'],
            ['name' => 'update-orders', 'display_name' => 'Update orders', 'description' => 'تعديل البائين', 'path' => 'orders'],
            ['name' => 'delete-orders', 'display_name' => 'Delete orders', 'description' => 'حذف البائين', 'path' => 'orders'],
            ['name' => 'accept-orders', 'display_name' => 'Accept orders', 'description' => 'الموافقة على الاوردر', 'path' => 'orders'],
            ['name' => 'Reject-orders', 'display_name' => 'Reject orders', 'description' => 'رفض الاوردر', 'path' => 'orders'],

            // coupons
            ['name' => 'read-coupons', 'display_name' => 'Read coupons', 'description' => 'عرض الكوبانات', 'path' => 'coupons'],
            ['name' => 'create-coupons', 'display_name' => 'Create coupons', 'description' => 'اضافة الكوبانات', 'path' => 'coupons'],
            ['name' => 'update-coupons', 'display_name' => 'Update coupons', 'description' => 'تعديل الكوبانات', 'path' => 'coupons'],
            ['name' => 'delete-coupons', 'display_name' => 'Delete coupons', 'description' => 'حذف الكوبانات', 'path' => 'coupons'],

            // roles
            ['name' => 'read-roles', 'display_name' => 'Read roles', 'description' => 'عرض الصلاحيات', 'path' => 'roles'],
            ['name' => 'create-roles', 'display_name' => 'Create roles', 'description' => 'اضافة الصلاحيات', 'path' => 'roles'],
            ['name' => 'update-roles', 'display_name' => 'Update roles', 'description' => 'تعديل الصلاحيات', 'path' => 'roles'],
            ['name' => 'delete-roles', 'display_name' => 'Delete roles', 'description' => 'حذف الصلاحيات', 'path' => 'roles'],

            // permissions
            ['name' => 'read-permissions', 'display_name' => 'Read permissions', 'description' => ' عرض الأذونات', 'path' => 'permissions'],
            ['name' => 'create-permissions', 'display_name' => 'Create permissions', 'description' => 'اضافة الأذونات', 'path' => 'permissions'],
            ['name' => 'update-permissions', 'display_name' => 'Update permissions', 'description' => 'تعديل الأذونات', 'path' => 'permissions'],
            ['name' => 'delete-permissions', 'display_name' => 'Delete permissions', 'description' => 'حذف الأذونات', 'path' => 'permissions'],

            // categories
            ['name' => 'read-categories', 'display_name' => 'Read categories', 'description' => 'عرض  التصنيفات  ', 'path' => 'categories'],
            ['name' => 'create-categories', 'display_name' => 'Create categories', 'description' => 'اضافة  التصنيفات  ', 'path' => 'categories'],
            ['name' => 'update-categories', 'display_name' => 'Update categories', 'description' => 'تعديل  التصنيفات  ', 'path' => 'categories'],
            ['name' => 'delete-categories', 'display_name' => 'Delete categories', 'description' => 'حذف  التصنيفات  ', 'path' => 'categories'],

            // products
            ['name' => 'read-products', 'display_name' => 'Read products', 'description' => 'عرض المنتجات  ', 'path' => 'products'],
            ['name' => 'create-products', 'display_name' => 'Create products', 'description' => 'اضافة  المنتجات  ', 'path' => 'products'],
            ['name' => 'update-products', 'display_name' => 'Update products', 'description' => 'تعديل  المنتجات  ', 'path' => 'products'],
            ['name' => 'delete-products', 'display_name' => 'Delete products', 'description' => 'حذف  المنتجات  ', 'path' => 'products'],

            // accounts
            ['name' => 'read-customers', 'display_name' => 'Read customers', 'description' => 'عرض  الزبائن  ', 'path' => 'customers'],
            ['name' => 'create-customers', 'display_name' => 'Create customers', 'description' => 'اضافة  الزبائن  ', 'path' => 'customers'],
            ['name' => 'update-customers', 'display_name' => 'Update customers', 'description' => 'تعديل  الزبائن  ', 'path' => 'customers'],
            ['name' => 'delete-customers', 'display_name' => 'Delete customers', 'description' => 'حذف  الزبائن  ', 'path' => 'customers'],


            ['name' => 'make_order_ship', 'display_name' => 'Make order ready to ship', 'description' => 'جعل الطلب جاهز للشحن ', 'path' => 'order'],
            ['name' => 'approve_orders_admin', 'display_name' => 'Make order ready to ship', 'description' => 'الموافقه على الطلب كأدمن ', 'path' => 'order'],
            ['name' => 'approve_orders_seller', 'display_name' => 'Approve orders Seller', 'description' => 'الموافقة على الطلب كتاجر ', 'path' => 'order'],
            ['name' => 'read-contact-us', 'display_name' => 'Read Contact Us', 'description' => 'عرض المراسلات ', 'path' => 'contact-us'],
            ['name' => 'create-contact-us', 'display_name' => 'Create Contact Us', 'description' => 'اضافة مراسلة جديدة ', 'path' => 'contact-us'],
            ['name' => 'read-orders-sellers', 'display_name' => 'Read orders sellers', 'description' => 'عرض الطلبات الخاصة بالبائع  ', 'path' => 'orders-sellers']
        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->initPermissions();
        // DB::table('permissions')->delete();
        foreach ($this->permissions as $item) {
            if (! DB::table('permissions')->where('name', $item['name'])->exists()) {
                Permission::updateOrCreate($item);
            }
        }

        $admins = [
            [
                'name' => 'Admin One',
                'email' => 'admin1@example.com',
                'username' => 'admin1',
            ],
            [
                'name' => 'Admin Two',
                'email' => 'admin2@example.com',
                'username' => 'admin2',
            ],
            [
                'name' => 'Admin Three',
                'email' => 'admin3@example.com',
                'username' => 'admin3',
            ],
            [
                'name' => 'Admin Four',
                'email' => 'admin4@example.com',
                'username' => 'admin4',
            ],
        ];

        foreach ($admins as $data) {
            Admin::create(array_merge($data, [
                'password' => Hash::make('password'),
                'type' => 'user',
                'status' => 'active',
                'phone' => '1234567890',
                'address' => '123 Admin St',
                'remember_token' => Str::random(10),
                'is_verified' => true,
                'is_suspended' => false,
                'is_deleted' => false,
                'created_by' => 'seeder',
                'updated_by' => 'seeder',
            ]));
        }
    }
}
