<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // ['name' => 'Access-Administrator', 'module_name' => 'Administrator'],
            // ['name' => 'Role-List', 'module_name' => 'Role'],
            // ['name' => 'Role-Create', 'module_name' => 'Role'],
            // ['name' => 'Role-Edit', 'module_name' => 'Role'],
            // ['name' => 'Role-Delete', 'module_name' => 'Role'],
            // ['name' => 'User-List', 'module_name' => 'User'],
            // ['name' => 'User-Create', 'module_name' => 'User'],
            // ['name' => 'User-Edit', 'module_name' => 'User'],
            // ['name' => 'User-Delete', 'module_name' => 'User'],
            // ['name' => 'User-Status', 'module_name' => 'User'],
            // ['name' => 'Permission-List', 'module_name' => 'Permission'],
            // ['name' => 'Permission-Create', 'module_name' => 'Permission'],
            // ['name' => 'Permission-Edit', 'module_name' => 'Permission'],
            // ['name' => 'Permission-Delete', 'module_name' => 'Permission'],
            // ['name' => 'Access-Department', 'module_name' => 'Department'],
            // ['name' => 'Division-List', 'module_name' => 'Division'],
            // ['name' => 'Division-Create', 'module_name' => 'Division'],
            // ['name' => 'Division-Edit', 'module_name' => 'Division'],
            // ['name' => 'Division-Delete', 'module_name' => 'Division'],
            // ['name' => 'Division-Status', 'module_name' => 'Division'],
            // ['name' => 'Station-List', 'module_name' => 'Station'],
            // ['name' => 'Station-Create', 'module_name' => 'Station'],
            // ['name' => 'Station-Edit', 'module_name' => 'Station'],
            // ['name' => 'Station-Delete', 'module_name' => 'Station'],
            // ['name' => 'Station-Status', 'module_name' => 'Station'],
        ];

        foreach ($permissions as $permission) {
             Permission::firstOrCreate([
                'name' => $permission['name'],
            ], [
                'module_name' => $permission['module_name']
            ]);
        }
    }
}
