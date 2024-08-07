<?php

namespace App\Http\Controllers;

use App\Models\Officerprofilephoto;
use App\Models\OfficerRank;
use App\Models\Officers;
use App\Models\PoliceDivision;
use App\Models\policestations;
use App\Models\Role;
use App\Models\User;
use App\Services\OfficerService;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Can;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class OfficerController extends Controller
{
    protected $officerService;

    public function __construct(OfficerService $officerService)
    {
        $this->officerService = $officerService;
    }

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
                        $btn .= '<a href="' . route('offieredit', ['id' => $row->id]) . '"  target="_self" title="Edit" data-bs-toggle="tooltip" data-bs-placement="top"  class="icon-button btn btn-info btn-sm mr-1 editbtn"><i class="material-icons">edit</i></a>';
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

                    if (auth()->user()->can('Officer-Delete')) {
                        $btn .= '<button class="btn btn-danger btn-sm mr-1 delete-btn" data-id="' . $row->id . '" title="Delete" data-bs-toggle="tooltip" data-bs-placement="top"><i class="material-icons">delete</i></button>';
                    }
                
                    $btn .= '</td>';

                    return $btn;
                })
                ->rawColumns(['rank', 'station', 'policedivision', 'action'])
                ->make(true);
        }

        return view('Department.Officers.officers');
    }


    public function store(Request $request, OfficerService $officerService){

        $result = $officerService->store($request);

            if ($result['status'] === 'success') {
                return redirect()->route('offiers')->with('message', $result['message']);
            }

            return redirect()->back()->withErrors($result['errors'])->withInput();

    }


    public function edit($officerID){

        $ranks = OfficerRank::all();
        $policedivisions = PoliceDivision::all();
        $stations = policestations::all();
        $officerinfo = Officers::find($officerID);

        $officerphoto = Officerprofilephoto::where('officer_id', $officerID)->first();

        return view('Department.Officers.editofficer', compact('ranks','policedivisions','stations','officerinfo','officerphoto'));

    }


    public function status($requestid, $statusid)
    {
        $message = $this->officerService->updateStatus($requestid, $statusid);

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

    public function createofficerlogin(Request $request)
    {

          $message = $this->officerService->createOfficerLogin($request);

        return redirect()->back()->with('message', $message);
    }

}
