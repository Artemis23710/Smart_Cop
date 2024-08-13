<?php

namespace App\Http\Controllers;

use App\Models\Maincrimecategory;
use App\Models\PoliceDivision;
use Illuminate\Http\Request;

class SuspectController extends Controller
{
    public function index(){
        return view('Criminals.Suspects.suspects');
    }

    public function newsuspect(){
        $policedivisions = PoliceDivision::all();
        $maincrimecategory = Maincrimecategory::all();
        return view('Criminals.Suspects.newsuspects', compact('policedivisions','maincrimecategory'));  
    }
}
