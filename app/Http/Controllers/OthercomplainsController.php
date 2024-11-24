<?php

namespace App\Http\Controllers;

use App\Models\complains;
use Illuminate\Http\Request;
use App\Models\PoliceDivision;
use App\Models\policestations;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class OthercomplainsController extends Controller
{
    public function index(){
        return view('Complains.Othercomplains.complains');
    }

    public function newothercomplains()
    {
        $policedivisions = PoliceDivision::all();
        return view('Complains.Othercomplains.newothercomplaints', compact('policedivisions'));  
    }

    public function insert(Request $request)
    {

        if ($request->hiddenid == 1) {

            $officer = complains::create([
                'complain_type' => $request->typeofcomplaint,
                'dateofcomplain' => $request->dateofcomplaint,
                'description' => $request->discription,
                'poctperson_name' => $request->fullname,
                'poctperson_idnumber' => $request->idcardno,
                'poctperson_contactno' => $request->contactno,
                'poctperson_address' => $request->permentaddress,
                'station' => $request->arreststationid,
                'status' => 1,
                'created_by' => Auth::id(),
                'updated_by' => 0
            ]);

            $message = 'Complaint Created Successfully.';
        }else{

            $complaints = complains::find($request->recordID);
            if ($complaints) {
    
                $complaints->update([
                    'complain_type' => $request->typeofcomplaint,
                    'dateofcomplain' => $request->dateofcomplaint,
                    'description' => $request->discription,
                    'poctperson_name' => $request->fullname,
                    'poctperson_idnumber' => $request->idcardno,
                    'poctperson_contactno' => $request->contactno,
                    'poctperson_address' => $request->permentaddress,
                    'station' => $request->arreststationid,
                    'updated_by' => Auth::id()
                ]);
                
            }
            $message = ' Complaint Updated Successfully.';

        }
        return redirect()->route('othercomplains')->with('message', $message);
    }

    public function showcomplaints(Request $request)
    {

        if ($request->ajax()) {

            $data = complains::whereIn('complains.status', [1, 2])
                            ->where('complain_type', '!=', 'Missing Persons')
                            ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $btn = '<td class="text-right">';
                    if (auth()->user()->can('Officer-Edit')) {
                        $btn .= '<a href="' . route('othercomplainsedit', ['id' => $row->id]) . '"  target="_self" title="Edit" data-bs-toggle="tooltip" data-bs-placement="top"  class="icon-button btn btn-info btn-sm mr-1 editbtn"><i class="material-icons">edit</i></a>';
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

        return view('Complains.Othercomplains.complains');
    }

    public function delete($requestid){
        $user = Auth::user();

        $user = complains::findOrFail($requestid);
            $user->status = 3;
            $user->updated_by = Auth::id();
            $user->save();

        $message = 'Complaint Deleted Succssfully.';
        return redirect()->back()->with('message', $message);
    }

    public function edit($complainID)
    {
        $policedivisions = PoliceDivision::all();
        $complaininfo = complains::find($complainID);
        $stations = policestations::all();
        $stationID = $complaininfo->station;

        $station = policestations::find($stationID);
        $divisionID = $station ? $station->division_id : null;
        return view('Complains.Othercomplains.editothercomplaints', compact('policedivisions','complaininfo','divisionID','stations'));  

    }


}
