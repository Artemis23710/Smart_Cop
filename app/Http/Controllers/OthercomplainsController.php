<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OthercomplainsController extends Controller
{
    public function index(){
        return view('Complains.Othercomplains.complains');
    }
}
