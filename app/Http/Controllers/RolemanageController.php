<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolemanageController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return view('Administrator.roles.roles', compact('roles'));
    }

    public function storeRole(Request $request)
    {
        $request->validate([
            'accountname' => 'required|string|max:255',
        ]);
    
        if ($request->hiddenid == 1) {

            Role::create(['name' => $request->accountname]);
            $message = 'Role successfully created.';

        } else {

            Role::findOrFail($request->recordID)->update(['name' => $request->accountname]);
            $message = 'Role successfully updated.';
            
        }
    
        return redirect()->back()->with('message', $message);
    }
    
    public function edit(Request $request){

        $id = Request('id');
        if (request()->ajax()) {
            $data = Role::find($id);
            return response()->json(['result' => $data]);
        }
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('rolelists')->with('success', 'Role deleted successfully');
    }



}
