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

        if ($request->hiddenid == 1) {

            PoliceDivision::create([
                'district_id' => $request->districtid,
                'division_name' => $request->divisionname,
                'status' => 1,
                'created_by' => Auth::id(),
                'update_by' => 0
            ]);
    
            $message = 'Division Created Successfully.';

        }else{

            
            $division = PoliceDivision::find($request->recordID);

            if ($division) {
                $division->update([
                    'district_id' => $request->districtid,
                    'division_name' => $request->divisionname,
                    'updated_by' => Auth::id()
                ]);

                $message = 'Division Updated Successfully.';
            }

        }
       
        return redirect()->back()->with('message', $message);
    }

  
    public function edit(Request $request)
    {
        $id = $request->input('id');
        if ($request->ajax()) {
            $division = PoliceDivision::with('district')->find($id);

            // Fetch the province_id from the related district
            $province_id = $division->district->province_id;

            // Fetch districts for the province
            $districts = Districts::where('province_id', $province_id)->get();
            return response()->json(['result' => $division, 'province_id' => $province_id, 'districts' => $districts]);
        }
    }


    public function status($requestid, $statusid)
    {
        $user = Auth::user();

        if($statusid == 1){

                $user = PoliceDivision::findOrFail($requestid);
                $user->status = 1;
                $user->updated_by = Auth::id();
                $user->save();

                $message = 'Division Activated Succssfully.';
        }elseif($statusid == 2){

            $user = PoliceDivision::findOrFail($requestid);
            $user->status = 2;
            $user->updated_by = Auth::id();
            $user->save();

            $message = 'Division Deactivated Succssfully.';

        }else{

            $user = PoliceDivision::findOrFail($requestid);
            $user->status = 3;
            $user->updated_by = Auth::id();
            $user->save();

            $message = 'Division Deleted Succssfully.';

        }

        return redirect()->back()->with('message', $message);
    }


}
