<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MissingpersonController extends Controller
{
    public function index(){
        return view('Complains.Missing.complains');
    }
}
