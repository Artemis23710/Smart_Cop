<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class Admincontroller extends Controller
{
    public function userdetails(){
        return view('Administrator.users.users');
    }

    
    public function permisiondetails(){
        return view('Administrator.privileges.priviliges');
    }

}
