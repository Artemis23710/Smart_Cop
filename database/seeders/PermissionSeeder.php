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
            // ['name' => 'Officer-List', 'module_name' => 'Officer'],
            // ['name' => 'Officer-Create', 'module_name' => 'Officer'],
            // ['name' => 'Officer-Edit', 'module_name' => 'Officer'],
            // ['name' => 'Officer-Delete', 'module_name' => 'Officer'],
            // ['name' => 'Officer-Status', 'module_name' => 'Officer'],
            // ['name' => 'Officer-Login', 'module_name' => 'Officer'],
            // ['name' => 'Access-Criminal', 'module_name' => 'Criminal'],
            // ['name' => 'Suspect-List', 'module_name' => 'Suspect'],
            // ['name' => 'Suspect-Create', 'module_name' => 'Suspect'],
            // ['name' => 'Suspect-Edit', 'module_name' => 'Suspect'],
            // ['name' => 'Suspect-Delete', 'module_name' => 'Suspect'],
            // ['name' => 'Suspect-Status', 'module_name' => 'Suspect'],
            // ['name' => 'Violent-crime-Suspect-List', 'module_name' => 'Violent-crime'],
            // ['name' => 'Violent-Crime_details-Add', 'module_name' => 'Violent-crime'],
            // ['name' => 'Violent-Crime_details-Edit', 'module_name' => 'Violent-crime'],
            // ['name' => 'Violent-Crime_details-Delete', 'module_name' => 'Violent-crime'],
            // ['name' => 'Violent-Crime_Judgement-Add', 'module_name' => 'Violent-crime'],
            // ['name' => 'Violent-Crime_Judgement-Edit', 'module_name' => 'Violent-crime'],
            // ['name' => 'Violent-Crime_Judgement-Delete', 'module_name' => 'Violent-crime'],
            // ['name' => 'Other-crime-Suspect-List', 'module_name' => 'Other Crime'],
            // ['name' => 'Other-Crime_details-Add', 'module_name' => 'Other Crime'],
            // ['name' => 'Other-Crime_details-Edit', 'module_name' => 'Other Crime'],
            // ['name' => 'Other-Crime_details-Delete', 'module_name' => 'Other Crime'],
            // ['name' => 'Other-Crime_Judgement-Add', 'module_name' => 'Other Crime'],
            // ['name' => 'Other-Crime_Judgement-Edit', 'module_name' => 'Other Crime'],
            // ['name' => 'Other-Crime_Judgement-Delete', 'module_name' => 'Other Crime'],
            // ['name' => 'Financial-crime-Suspect-List', 'module_name' => 'Financial Crime'],
            // ['name' => 'Financial-Crime_details-Add', 'module_name' => 'Financial Crime'],
            // ['name' => 'Financial-Crime_details-Edit', 'module_name' => 'Financial Crime'],
            // ['name' => 'Financial-Crime_details-Delete', 'module_name' => 'Financial Crime'],
            // ['name' => 'Financial-Crime_Judgement-Add', 'module_name' => 'Financial Crime'],
            // ['name' => 'Financial-Crime_Judgement-Edit', 'module_name' => 'Financial Crime'],
            // ['name' => 'Financial-Crime_Judgement-Delete', 'module_name' => 'Financial Crime'],
            // ['name' => 'Serious-crime-Suspect-List', 'module_name' => 'Serious Crime'],
            // ['name' => 'Serious-Crime_details-Add', 'module_name' => 'Serious Crime'],
            // ['name' => 'Serious-Crime_details-Edit', 'module_name' => 'Serious Crime'],
            // ['name' => 'Serious-Crime_details-Delete', 'module_name' => 'Serious Crime'],
            // ['name' => 'Serious-Crime_Judgement-Add', 'module_name' => 'Serious Crime'],
            // ['name' => 'Serious-Crime_Judgement-Edit', 'module_name' => 'Serious Crime'],
            // ['name' => 'Serious-Crime_Judgement-Delete', 'module_name' => 'Serious Crime'],
            // ['name' => 'Convicted-Criminals-List', 'module_name' => 'Convicted Criminals'],
            // ['name' => 'Investigation-List', 'module_name' => 'Investigation'],
            // ['name' => 'Investigation-Create', 'module_name' => 'Investigation'],
            // ['name' => 'Investigation-Edit', 'module_name' => 'Investigation'],
            // ['name' => 'Investigation-Delete', 'module_name' => 'Investigation'],
            // ['name' => 'Investigation-Status', 'module_name' => 'Investigation'],
            // ['name' => 'Ongoing-Investigation-List', 'module_name' => 'Ongoing-Investigation'],
            // ['name' => 'Closed-Investigation-List', 'module_name' => 'Closed-Investigation'],
            // ['name' => 'Investigation-Crime-Note-Add', 'module_name' => 'Ongoing Investigation'],
            // ['name' => 'Investigation-Crime-Note-Edit', 'module_name' => 'Ongoing Investigation'],
            // ['name' => 'Investigation-Crime-Note-Delete', 'module_name' => 'Ongoing Investigation'],
            // ['name' => 'Investigation-Closing-Add', 'module_name' => 'Ongoing Investigation'],

           
          
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
