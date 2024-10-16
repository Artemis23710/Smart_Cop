<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilesettingController extends Controller
{
    public function index(){
        return view('layouts.profile');
    }
    public function settings(){
        return view('layouts.setting');
    }
}
