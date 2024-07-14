<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;

class UsermanageController extends Controller
{
    public function index(){

        $roles = Role::all();
        $users = User::with('role')
        ->whereIn('status', [1, 2])
        ->select('id','role_id', 'name', 'email', 'status')
        ->get();
        return view('Administrator.users.users', compact('roles','users'));
    }

    public function store(Request $request){

        if ($request->hiddenid == 1) {

            $validator = Validator::make($request->all(), [
                'accountname' => 'required|string|max:255',
                'useremail' => 'required|email|unique:users,email',
                'password' => 'required|string|confirmed',
                'roleid' => 'required|exists:roles,id',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }else{
    
                $user =User::create([
                    'role_id' => $request->input('roleid'),
                    'name' => $request->input('accountname'),
                    'email' => $request->input('useremail'),
                    'password' => Hash::make($request->input('password')),
                    'status' => 1,
                    'created_by' => Auth::id(),
                    'update_by' => 0
                ]);


                // Find the role by id
                $role = Role::findById($request->input('roleid'));
                // Assign the role to the user
                $user->assignRole($role);
    
                $message = 'User successfully created.';
            }
        } else
        {

            $validator = Validator::make($request->all(), [
                'accountname' => 'required|string|max:255',
                'useremail' => 'required|email|unique:users,email,' . $request->recordID,
                'roleid' => 'required|exists:roles,id',
                'password' => 'nullable|string|confirmed',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } 
            else {

                $user = User::findOrFail($request->recordID);
                $user->role_id = $request->input('roleid');
                $user->name = $request->input('accountname');
                $user->email = $request->input('useremail');
                
                if ($request->filled('password')) {
                    $user->password = Hash::make($request->input('password'));
                }

                $user->updated_by = Auth::id();
                $user->save();
                // Find the role by id
                $role = Role::findById($request->input('roleid'));
                // Assign the role to the user (if role is changed)
                $user->syncRoles([$role]);


                $message = 'User successfully updated.';
            }
        }
        
        return redirect()->back()->with('message', $message);
    }

    public function edit(Request $request){

        $id = Request('id');
        if (request()->ajax()) {
            $data = User::find($id);
            return response()->json(['result' => $data]);
        }
    }

    public function status($requestid, $statusid)
    {
        $user = Auth::user();

        if($statusid == 1){

                $user = User::findOrFail($requestid);
                $user->status = 1;
                $user->updated_by = Auth::id();
                $user->save();

                $message = 'User Account Activated Succssfully.';
        }elseif($statusid == 2){

            $user = User::findOrFail($requestid);
            $user->status = 2;
            $user->updated_by = Auth::id();
            $user->save();

            $message = 'User Account Deactivated Succssfully.';

        }else{

            $user = User::findOrFail($requestid);
            $user->status = 3;
            $user->updated_by = Auth::id();
            $user->save();

            $message = 'User Account Deleted Succssfully.';

        }

        return redirect()->back()->with('message', $message);
    }

    
}
