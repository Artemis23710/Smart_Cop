<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OfficerController extends Controller
{
    public function index(){
        return view('Department.Officers.officers');
    }

    public function newofficer(){
        return view('Department.Officers.newofficer');
    }
}
