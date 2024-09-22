<?php

namespace App\Http\Controllers;

use App\Models\Crimelist;
use App\Models\investigation_details;
use App\Models\investigation_vicims;
use App\Models\Maincrimecategory;
use App\Models\Officers;
use App\Models\PoliceDivision;
use App\Models\policestations;
use App\Services\InvestigationService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class InvestigationController extends Controller
{
    protected $invetigationservice;

    public function __construct(InvestigationService $invetigationservice)
    {
        $this->invetigationservice = $invetigationservice;
    }

    public function index(){
        return view('Investigations.New_Investigation.investigation');
    }

    public function newinvestigation()
    {
        $policedivisions = PoliceDivision::all();
        $maincrimecategory = Maincrimecategory::all();
        $officers = Officers::where('status',1)->get();

        // generate case no
        $currentYear = Carbon::now()->year;
        $lastRecord = DB::table('investigation_details')->orderBy('id', 'desc')->first();
        $newId = $lastRecord ? $lastRecord->id + 1 : 1;
        $newCaseNo = str_pad($newId, 4, '0', STR_PAD_LEFT);
        $caseNo = "ICN-{$currentYear}-{$newCaseNo}";


        return view('Investigations.New_Investigation.new_investigation', compact('policedivisions','maincrimecategory','officers','caseNo'));  
    }

    public function store(Request $request, InvestigationService $invetigationservice)
    {
        $massage = $invetigationservice->store($request);
        return redirect()->route('investigations')->with('message', $massage);
    }

    public function showinvestigations(Request $request)
    {
        if ($request->ajax()) {

            $data = investigation_details::with(['crimemain','crime'])
                            ->whereIn('investigation_details.status', [1, 2])
                            ->where('investigation_details.investigation_status', 0)
                            ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('crimemain', function($row){
                    return $row->crimemain->main_crime_category ?? 'N/A';
                })
                ->addColumn('crime', function($row){
                    return $row->crime->crime ?? 'N/A';
                })

                ->addColumn('action', function($row) {
                    $btn = '<td class="text-right">';
                    if (auth()->user()->can('Investigation-Edit')) {
                        $btn .= '<a href="' . route('investigationsedit', ['id' => $row->id]) . '"  target="_self" title="Edit" data-bs-toggle="tooltip" data-bs-placement="top"  class="icon-button btn btn-info btn-sm mr-1 editbtn"><i class="material-icons">edit</i></a>';
                    }
                    if (auth()->user()->can('Investigation-Status')) {
                        if ($row->status == 1) {
                            $btn .= '<a href="' . route('investigationstatus', ['id' => $row->id, 'status' => 2]) . '" onclick="return deactive_confirm()" target="_self" title="Deactivate" data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-success btn-sm mr-1"><i class="fas fa-check"></i></a>';
                        } else {
                            $btn .= '<a href="' . route('investigationstatus', ['id' => $row->id, 'status' => 1]) . '" onclick="return active_confirm()" target="_self" title="Activate" data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-warning btn-sm mr-1"><i class="fas fa-times"></i></a>';
                        }
                    }
                    if (auth()->user()->can('Investigation-Delete')) {
                        $btn .= '<button class="btn btn-danger btn-sm mr-1 delete-btn" data-id="' . $row->id . '" title="Delete" data-bs-toggle="tooltip" data-bs-placement="top"><i class="material-icons">delete</i></button>';
                    }
                    return $btn;
                })
                ->rawColumns(['crimemain',  'crime', 'action'])
                ->make(true);
        }
    }

    public function status($requestid, $statusid)
    {
        $message = $this->invetigationservice->updateStatus($requestid, $statusid);
        return redirect()->back()->with('message', $message);
    }

    public function edit($investigationID)
    {
        $policedivisions = PoliceDivision::all();
        $maincrimecategory = Maincrimecategory::all();
        $officers = Officers::where('status',1)->get();
        $stations = policestations::all();

        $investigationinfo = investigation_details::find($investigationID);
        $victims = investigation_vicims::where('investigation_id', $investigationID)->where('status', 1)->get();

        $stationID = $investigationinfo->arrested_station;
        $station = policestations::find($stationID);
        $divisionID = $station ? $station->division_id : null;

        $categoryID = $investigationinfo->arrested_crime_category;
        $crimelists = Crimelist::where('category_id', $categoryID)->get();

        return view('Investigations.New_Investigation.edit_investigation', compact('policedivisions','maincrimecategory','officers','stations','investigationinfo','victims','divisionID','crimelists')); 
    }

    public function victimdelete($requestid){

        $victims = investigation_vicims::findOrFail($requestid);
        $victims->status = 3;
        $victims->save();

        $message = 'Investigation Victim Deleted Successfully.';
        return redirect()->back()->with('message', $message);
    }

}
