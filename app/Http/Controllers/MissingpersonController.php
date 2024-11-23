<?php

namespace App\Http\Controllers;

use App\Models\complains;
use Illuminate\Http\Request;
use App\Models\PoliceDivision;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
class MissingpersonController extends Controller
{
    public function index()
    {
        return view('Complains.Missing.complains');
    }

    public function newmissingcomplains()
    {
        $policedivisions = PoliceDivision::all();
        return view('Complains.Missing.newcomplains', compact('policedivisions'));  
    }

    public function insert(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'idcardno' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'fullname' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female',
            'officerdob' => 'required|date',
            'suspectage' => 'required',
            'officerphoto' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'error',
                'errors' => $validator->errors(),
            ];
        }

        if ($request->hiddenid == 1) {

            if ($request->hasFile('officerphoto')) {
                $file = $request->file('officerphoto');
                $fileName = now()->year . '-' . $request->idcardno . '.' . $file->getClientOriginalExtension();
                $officerPhotoPath = $file->storeAs('Missing', $fileName, 'Missing');
            }


            $officer = complains::create([
                'complain_type' => "Missing Persons",
                'dateofcomplain' => $request->complaindate,
                'description' => $request->discription,
                'missingperson_id' => $request->idcardno,
                'missingperson_fname' => $request->firstname,
                'missingperson_mname' => $request->middlename,
                'missingperson_lname' => $request->lastname,
                'missingperson_fullname' => $request->fullname,
                'missingperson_gender' => $request->gender,
                'missingperson_dob' => $request->officerdob,
                'missingperson_age' => $request->suspectage,
                'missingperson_nationality' => $request->nationality,
                'missingperson_lastseen' => $request->lastseenat,
                'missingperson_image' => $officerPhotoPath,
                'poctperson_name' => $request->fullnameperson,
                'poctperson_relation' => $request->relation,
                'poctperson_idnumber' => $request->idcardnoperson,
                'poctperson_contactno' => $request->contactno,
                'poctperson_address' => $request->permentaddress,
                'station' => $request->arreststationid,
                'status' => 1,
                'created_by' => Auth::id(),
                'updated_by' => 0
            ]);

            $message = 'Missing Person Complaint Created Successfully.';
        }
        return redirect()->route('missingpersioncomplains')->with('message', $message);
    }

    public function showcomplaints(Request $request){

        if ($request->ajax()) {

            $data = complains::whereIn('complains.status', [1, 2])
                            ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                
                ->addColumn('action', function($row) {
                    $btn = '<td class="text-right">';
                    
                    if (auth()->user()->can('Officer-Edit')) {
                        $btn .= '<a href="' . route('offieredit', ['id' => $row->id]) . '"  target="_self" title="Edit" data-bs-toggle="tooltip" data-bs-placement="top"  class="icon-button btn btn-info btn-sm mr-1 editbtn"><i class="material-icons">edit</i></a>';
                    }

                    if (auth()->user()->can('Officer-Delete')) {
                        $btn .= '<button class="btn btn-danger btn-sm mr-1 delete-btn" data-id="' . $row->id . '" title="Delete" data-bs-toggle="tooltip" data-bs-placement="top"><i class="material-icons">delete</i></button>';
                    }
                    $btn .= '</td>';
                    return $btn;
                })
                ->rawColumns(['station','action'])
                ->make(true);
        }

        return view('Complains.Missing.complains');
    }

    public function delete($requestid){
        $user = Auth::user();

        $user = complains::findOrFail($requestid);
            $user->status = 3;
            $user->updated_by = Auth::id();
            $user->save();

        $message = 'Missing Person Complaint Deleted Succssfully.';
        return redirect()->back()->with('message', $message);
    }
    
    
}
