<?php

namespace App\Http\Controllers;

use App\Models\Officerprofilephoto;
use App\Models\OfficerRank;
use App\Models\Officers;
use App\Models\PoliceDivision;
use App\Models\policestations;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Can;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class OfficerController extends Controller
{
    public function index(){

        $roles = Role::where('id', '!=', 1)->get();
        return view('Department.Officers.officers', compact('roles'));
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

    public function showofficers(Request $request)
    {
        if ($request->ajax()) {

            $data = Officers::with(['rank', 'station.policedivision'])
                            ->whereIn('officers.status', [1, 2])
                            ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('rank', function($row){
                    return $row->rank->Rank_name ?? 'N/A';
                })
                ->addColumn('station', function($row){
                    return $row->station->station_name ?? 'N/A';
                })
                ->addColumn('policedivision', function($row){
                    return $row->station->policedivision->division_name ?? 'N/A';
                })
                ->addColumn('action', function($row) {
                    $btn = '<td class="text-right">';
                    
                    if (auth()->user()->can('Officer-Edit')) {
                        $btn .= '<button class="icon-button btn btn-info btn-sm mr-1 editbtn" title="Edit" data-bs-toggle="tooltip" data-bs-placement="top" id="' . $row->id . '"><i class="material-icons">edit</i></button>';
                    }

                        // Check if user exists
                    $userExists = User::where('emp_id', $row->id)->exists();

                    if (auth()->user()->can('Officer-Login') && !$userExists) {
                        $btn .= '<button class="icon-button btn btn-warning btn-sm mr-1 useraccbtn" title="User Access" data-bs-toggle="tooltip" data-bs-placement="top" id="' . $row->id . '"><i class="material-icons">people</i></button>';
                    }

                 
                    if (auth()->user()->can('Officer-Status')) {
                        if ($row->status == 1) {
                            $btn .= '<a href="' . route('offiersstatus', ['id' => $row->id, 'status' => 2]) . '" onclick="return deactive_confirm()" target="_self" title="Deactivate" data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-success btn-sm mr-1"><i class="fas fa-check"></i></a>';
                        } else {
                            $btn .= '<a href="' . route('offiersstatus', ['id' => $row->id, 'status' => 1]) . '" onclick="return active_confirm()" target="_self" title="Activate" data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-warning btn-sm mr-1"><i class="fas fa-times"></i></a>';
                        }
                    }

                    if (auth()->user()->can('Officer-Login')) {
                        $btn .= '<a href="' . route('offiersstatus', ['id' => $row->id, 'status' => 3]) . '" onclick="return delete_confirm()" target="_self" title="Delete" data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-danger btn-sm mr-1"><i class="material-icons">delete</i></a>';
                    }
                
                    $btn .= '</td>';

                    return $btn;
                })
                ->rawColumns(['rank', 'station', 'policedivision', 'action'])
                ->make(true);
        }

        return view('Department.Officers.officers');
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
                    'updated_by' => 0
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




    public function status($requestid, $statusid)
    {
        $user = Auth::user();

        if($statusid == 1){

                $user = Officers::findOrFail($requestid);
                $user->status = 1;
                $user->updated_by = Auth::id();
                $user->save();

                $message = 'Officer Activated Succssfully.';
        }elseif($statusid == 2){

            $user = Officers::findOrFail($requestid);
            $user->status = 2;
            $user->updated_by = Auth::id();
            $user->save();

            $message = 'Officer Deactivated Succssfully.';

        }else{

            $user = Officers::findOrFail($requestid);
            $user->status = 3;
            $user->updated_by = Auth::id();
            $user->save();

            $message = 'Officer Deleted Succssfully.';

        }

        return redirect()->back()->with('message', $message);
    }


    public function checkIdCard(Request $request)
    {
        $exists = Officers::where('idcardno', $request->idcardno)->exists();
        return response()->json(['exists' => $exists]);
    }

    public function checkOfficerId(Request $request)
    {
        $exists = Officers::where('officerid', $request->officerid)->exists();
        return response()->json(['exists' => $exists]);
    }

    public function createofficerlogin(Request $request){

        $validator = Validator::make($request->all(), [
            'accountname' => 'required|string|max:255',
            'useremail' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed',
            'roleid' => 'required|exists:roles,id',
            'recordID' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } 
        else {

            $user =User::create([
                'emp_id' => $request->input('recordID'),
                'role_id' => $request->input('roleid'),
                'name' => $request->input('accountname'),
                'email' => $request->input('useremail'),
                'password' => Hash::make($request->input('password')),
                'status' => 1,
                'created_by' => Auth::id(),
                'update_by' => 0
            ]);
    
            $role = Role::findById($request->input('roleid'));
            $user->assignRole($role);
    
            $message = 'Officer User Access successfully created.';
        }

        return redirect()->back()->with('message', $message);
    }

}
