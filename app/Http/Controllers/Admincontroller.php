<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Admincontroller extends Controller
{
    public function index(){
        $roles = Role::all();
        return view('Administrator.privileges.priviliges', compact('roles'));
    }

    public function addprivilegesview($requestid){

        $role = Role::findOrFail($requestid);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->all();
        $permsWithModules = Permission::select('module_name')
            ->distinct()
            ->get()
            ->toArray();


        return view('Administrator.privileges.addpriviliges', compact('requestid','role','permissions','rolePermissions','permsWithModules'));
    }

    public function updateprivilegies(Request $request)
    {
        $request->validate([
            'requestid' => 'required|integer',
            'role_name' => 'required|string',
            'permissions' => 'array',
            'permissions.*' => 'integer|exists:permissions,id',
        ]);

        $role = Role::findByName($request->input('role_name'));

        $permissions = Permission::whereIn('id', $request->input('permissions', []))->get();
    
        $role->syncPermissions($permissions);

        $message = 'Permissions updated successfully.';

            return redirect()->route('permisionlist')->with('message', $message);
    }

}
