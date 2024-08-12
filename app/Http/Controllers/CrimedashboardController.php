<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrimedashboardController extends Controller
{
    public function index(){

        return view('Dashboards.investigationdashboard');

    }
}
