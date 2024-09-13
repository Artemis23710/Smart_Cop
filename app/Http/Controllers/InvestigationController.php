<?php

namespace App\Http\Controllers;

use App\Models\Maincrimecategory;
use App\Models\PoliceDivision;
use Illuminate\Http\Request;

class InvestigationController extends Controller
{
    public function index(){
        return view('Investigations.New_Investigation.investigation');
    }

    public function newinvestigation(){
        $policedivisions = PoliceDivision::all();
        $maincrimecategory = Maincrimecategory::all();
        return view('Investigations.New_Investigation.new_investigation', compact('policedivisions','maincrimecategory'));  
    }

}
