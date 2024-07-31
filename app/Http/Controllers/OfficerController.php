<?php

namespace App\Http\Controllers;

use App\Models\Officerprofilephoto;
use App\Models\OfficerRank;
use App\Models\Officers;
use App\Models\PoliceDivision;
use App\Models\policestations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfficerController extends Controller
{
    public function index(){
        return view('Department.Officers.officers');
    }

    public function newofficer(){
        $ranks = OfficerRank::all();
        $policedivisions = PoliceDivision::all();
        return view('Department.Officers.newofficer', compact('ranks','policedivisions'));
    }

    public function getpolicestation($divisionID)
    {
        $stations = policestations::where('division_id', $divisionID)->get();
        return response()->json($stations);
    }

    public function store(Request $request){

        $request->validate([
            'idcardno' => 'required|string|max:255',
            'officerid' => 'required|string|max:255',
            'namewithintial' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'fullname' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female',
            'officerdob' => 'required|date',
            'contactno' => 'required|string|max:15',
            'officeremail' => 'nullable|email|max:255',
            'permentaddress' => 'required|string|max:255',
            'officercity' => 'required|string|max:255',
            'temporyaddress' => 'nullable|string|max:255',
            'stationid' => 'required|integer',
            'rankid' => 'required|integer',
            'joinservicedate' => 'required|date',
            'resignationdate' => 'nullable|date',
            'officerphoto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $keywords = $request->idcardno . ' ' . $request->officerid . ' ' . $request->firstname . ' ' . $request->middlename . ' ' . $request->lastname;

        if ($request->hiddenid == 1){

            $officer = Officers::create([
                    'Keywords' => $keywords,
                    'idcardno' => $request->idcardno,
                    'officerid' => $request->officerid,
                    'namewithintial' => $request->namewithintial,
                    'firstname' => $request->firstname,
                    'middlename' => $request->middlename,
                    'lastname'  => $request->lastname,
                    'fullname' => $request->fullname,
                    'gender' => $request->gender,
                    'officerdob' => $request->officerdob,
                    'contactno' => $request->contactno,
                    'officeremail' => $request->officeremail,
                    'permentaddress' => $request->permentaddress,
                    'officercity' => $request->officercity,
                    'temporyaddress' => $request->temporyaddress,
                    'joinservicedate' => $request->joinservicedate,
                    'resignationdate' => $request->resignationdate,
                    'stationid' => $request->stationid,
                    'rankid' => $request->rankid,
                    'status' => 1,
                    'created_by' => Auth::id(),
                    'update_by' => 0
                ]);

             $savedOfficerId = $officer->id;

             $officerPhotoPath = null;
        
             if ($request->hasFile('officerphoto')) {
                 $file = $request->file('officerphoto');
                 $fileName = now()->year . '-' . $request->officerid . '.' . $file->getClientOriginalExtension();
                 $officerPhotoPath = $file->storeAs('officers', $fileName, 'public/Photos/Officers');

                 Officerprofilephoto::create([
                    'officer_id' => $savedOfficerId,
                    'photourl' => $officerPhotoPath,
                    'status' => 1
                ]);
             }

             $message = 'Officer Information Saved Successfully.';
        }else{

            $policeofficers = Officers::find($request->recordID);
            if($policeofficers){

                $policeofficers->update([
                    'Keywords' => $keywords,
                    'idcardno' => $request->idcardno,
                    'officerid' => $request->officerid,
                    'namewithintial' => $request->namewithintial,
                    'firstname' => $request->firstname,
                    'middlename' => $request->middlename,
                    'lastname'  => $request->lastname,
                    'fullname' => $request->fullname,
                    'gender' => $request->gender,
                    'officerdob' => $request->officerdob,
                    'contactno' => $request->contactno,
                    'officeremail' => $request->officeremail,
                    'permentaddress' => $request->permentaddress,
                    'officercity' => $request->officercity,
                    'temporyaddress' => $request->temporyaddress,
                    'joinservicedate' => $request->joinservicedate,
                    'resignationdate' => $request->resignationdate,
                    'stationid' => $request->stationid,
                    'rankid' => $request->rankid,
                    'updated_by' => Auth::id()
                ]);
                
                $message = 'Officer Information Updated Successfully.';

                // $officerPhotoPath = null;
        
                // if ($request->hasFile('officerphoto')) {
                //     $file = $request->file('officerphoto');
                //     $fileName = now()->year . '-' . $request->officerid . '.' . $file->getClientOriginalExtension();
                //     $officerPhotoPath = $file->storeAs('officers', $fileName, 'public/Photos/Officers');
   
                //     Officerprofilephoto::create([
                //        'officer_id' => $savedOfficerId,
                //        'photourl' => $officerPhotoPath,
                //        'status' => 1
                //    ]);
                // }
            }


        }

        return redirect()->back()->with('message', $message);
    }

    
}
