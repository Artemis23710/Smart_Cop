<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CriminaldashboardController extends Controller
{
    public function index(){

        return view('Dashboards.criminaldashboard');

    }
}
