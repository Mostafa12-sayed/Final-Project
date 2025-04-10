<?php

namespace Modules\Dashboard\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Dashboard\app\Models\Permission;

class PermissionSeeder extends Seeder
{
    public $permissions = [];

    public function initPermissions()
    {
        $perfix = "dash_";

        $this->permissions = [
            ['name' => $perfix . 'read-accounting','display_name' => 'Read Accounting Module','description' => 'عرض  مديول الحسابات','path' => 'modules'],

            //settings
            ['name' => $perfix . 'read-settings', 'display_name' => 'Read settings', 'description' => 'عرض الاعدادات   ', 'path' => 'settings'],
            ['name' => $perfix . 'update-settings', 'display_name' => 'Update settings', 'description' => 'تعديل الاعدادات   ', 'path' => 'settings'],

            //admins
            ['name' => $perfix . 'read-admins', 'display_name' => 'Read Admins', 'description' => 'عرض المشرفين', 'path' => 'admins'],
            ['name' => $perfix . 'create-admins', 'display_name' => 'Create Admins', 'description' => 'اضافة المشرفين', 'path' => 'admins'],
            ['name' => $perfix . 'update-admins', 'display_name' => 'Update Admins', 'description' => 'تعديل المشرفين', 'path' => 'admins'],
            ['name' => $perfix . 'delete-admins', 'display_name' => 'Delete Admins', 'description' => 'حذف المشرفين', 'path' => 'admins'],


            //admins
            ['name' => $perfix . 'read-sellers', 'display_name' => 'Read sellers', 'description' => 'عرض البائين', 'path' => 'sellers'],
            ['name' => $perfix . 'create-sellers', 'display_name' => 'Create sellers', 'description' => 'اضافة البائين', 'path' => 'sellers'],
            ['name' => $perfix . 'update-sellers', 'display_name' => 'Update sellers', 'description' => 'تعديل البائين', 'path' => 'sellers'],
            ['name' => $perfix . 'delete-sellers', 'display_name' => 'Delete sellers', 'description' => 'حذف البائين', 'path' => 'sellers'],


            //orders
            ['name' => $perfix . 'read-orders', 'display_name' => 'Read orders', 'description' => 'عرض البائين', 'path' => 'orders'],
            ['name' => $perfix . 'create-orders', 'display_name' => 'Create orders', 'description' => 'اضافة البائين', 'path' => 'orders'],
            ['name' => $perfix . 'update-orders', 'display_name' => 'Update orders', 'description' => 'تعديل البائين', 'path' => 'orders'],
            ['name' => $perfix . 'delete-orders', 'display_name' => 'Delete orders', 'description' => 'حذف البائين', 'path' => 'orders'],
            ['name' => $perfix . 'accept-orders', 'display_name' => 'Accept orders', 'description' => 'الموافقة على الاوردر', 'path' => 'orders'],
            ['name' => $perfix . 'Reject-orders', 'display_name' => 'Reject orders', 'description' => 'رفض الاوردر', 'path' => 'orders'],


            //coupons
            ['name' => $perfix . 'read-coupons', 'display_name' => 'Read coupons', 'description' => 'عرض الكوبانات', 'path' => 'coupons'],
            ['name' => $perfix . 'create-coupons', 'display_name' => 'Create coupons', 'description' => 'اضافة الكوبانات', 'path' => 'coupons'],
            ['name' => $perfix . 'update-coupons', 'display_name' => 'Update coupons', 'description' => 'تعديل الكوبانات', 'path' => 'coupons'],
            ['name' => $perfix . 'delete-coupons', 'display_name' => 'Delete coupons', 'description' => 'حذف الكوبانات', 'path' => 'coupons'],
         



            //roles
            ['name' => $perfix . 'read-roles', 'display_name' => 'Read roles', 'description' => 'عرض الصلاحيات', 'path' => 'roles'],
            ['name' => $perfix . 'create-roles', 'display_name' => 'Create roles', 'description' => 'اضافة الصلاحيات', 'path' => 'roles'],
            ['name' => $perfix . 'update-roles', 'display_name' => 'Update roles', 'description' => 'تعديل الصلاحيات', 'path' => 'roles'],
            ['name' => $perfix . 'delete-roles', 'display_name' => 'Delete roles', 'description' => 'حذف الصلاحيات', 'path' => 'roles'],



            //categories
            ['name' => $perfix . 'read-categories', 'display_name' => 'Read categories', 'description' => 'عرض  التصنيفات  ', 'path' => 'categories'],
            ['name' => $perfix . 'create-categories', 'display_name' => 'Create categories', 'description' => 'اضافة  التصنيفات  ', 'path' => 'categories'],
            ['name' => $perfix . 'update-categories', 'display_name' => 'Update categories', 'description' => 'تعديل  التصنيفات  ', 'path' => 'categories'],
            ['name' => $perfix . 'delete-categories', 'display_name' => 'Delete categories', 'description' => 'حذف  التصنيفات  ', 'path' => 'categories'],

            //products
            ['name' => $perfix . 'read-products', 'display_name' => 'Read products', 'description' => 'عرض المنتجات  ', 'path' => 'products'],
            ['name' => $perfix . 'create-products', 'display_name' => 'Create products', 'description' => 'اضافة  المنتجات  ', 'path' => 'products'],
            ['name' => $perfix . 'update-products', 'display_name' => 'Update products', 'description' => 'تعديل  المنتجات  ', 'path' => 'products'],
            ['name' => $perfix . 'delete-products', 'display_name' => 'Delete products', 'description' => 'حذف  المنتجات  ', 'path' => 'products'],

            

           


            
            //accounts
            ['name' => $perfix . 'read-customers', 'display_name' => 'Read customers', 'description' => 'عرض  الزبائن  ', 'path' => 'customers'],
            ['name' => $perfix . 'create-customers', 'display_name' => 'Create customers', 'description' => 'اضافة  الزبائن  ', 'path' => 'customers'],
            ['name' => $perfix . 'update-customers', 'display_name' => 'Update customers', 'description' => 'تعديل  الزبائن  ', 'path' => 'customers'],
            ['name' => $perfix . 'delete-customers', 'display_name' => 'Delete customers', 'description' => 'حذف  الزبائن  ', 'path' => 'customers'],



            

          


           
           



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
            if (!DB::table('permissions')->where('name', $item['name'])->exists()) {
                Permission::updateOrCreate($item);
            }
        }
    }
}
