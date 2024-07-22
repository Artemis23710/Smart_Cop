<?php

namespace App\Http\Controllers;

use App\Models\Districts;
use App\Models\PoliceDivision;
use App\Models\provinces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DivisionController extends Controller
{
    public function index(){

        $provinces = provinces::all();
        return view('Department.Division.division' ,compact('provinces'));
    }

    public function getDistricts($provinceId)
    {
        $districts = Districts::where('province_id', $provinceId)->get();
        return response()->json($districts);
    }


    public function store(Request $request)
    {
        $request->validate([
            'provinceid' => 'required|exists:provinces,id',
            'districtid' => 'nullable|exists:districts,id',
            'divisionname' => 'required|string|max:255',
        ]);

        PoliceDivision::create([
            'district_id' => $request->districtid,
            'division_name' => $request->divisionname,
            'status' => 1,
            'created_by' => Auth::id(),
            'update_by' => 0
        ]);

        $message = 'Division created successfully.';
        return redirect()->back()->with('message', $message);
    }
}
