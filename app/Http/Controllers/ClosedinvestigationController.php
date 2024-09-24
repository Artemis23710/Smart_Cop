<?php

namespace App\Http\Controllers;

use App\Models\Crime_investigation_closing;
use App\Models\CrimeDetails;
use App\Models\Crimelist;
use App\Models\investigation_vicims;
use App\Models\Maincrimecategory;
use App\Models\investigation_details;
use App\Models\PoliceDivision;
use App\Models\policestations;
use App\Models\Officers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ClosedinvestigationController extends Controller
{
    public function index()
    {
        return view('Investigations.Closed_Investigation.closedinvestigation');
    }

    public function showclosedinvestigations(Request $request)
    {
        if ($request->ajax()) {

            $data = investigation_details::with(['crimemain','crime'])
                            ->whereIn('investigation_details.status', [1, 2])
                            ->where('investigation_details.investigation_status', 1)
                            ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('crimemain', function($row){
                    return $row->crimemain->main_crime_category ?? 'N/A';
                })
                ->addColumn('crime', function($row){
                    return $row->crime->crime ?? 'N/A';
                })
                ->addColumn('approve_status', function ($row) {
                    if ($row->approve_status == 0) {
                        return '<span class="text-danger">Not Approved</span>';
                    } elseif ($row->approve_status == 1) {
                        return '<span class="text-success">Approved</span>';
                    } else {
                        return '<span class="text-warning">Pending</span>';
                    }
                })
                ->addColumn('action', function($row) {
                    $btn = '<td class="text-right">';

                    if ($row->approve_status == 0 ) {
                        $btn .= '<a href="' . route('closedinvestigationsviewapprove', ['id' => $row->id]) . '"  target="_self" title="Approve" data-bs-toggle="tooltip" data-bs-placement="top"  class="icon-button btn btn-success btn-sm mr-1 editbtn"><i class="fas fa-check"></i></a>';
                    }
                   
                    if (auth()->user()->can('Investigation-Closing-Add')) {

                        $btn .= '<button class="btn btn-danger btn-sm mr-1 printdocuments-btn" id="' . $row->id . '" title="Print Details" data-bs-toggle="tooltip" data-bs-placement="top"><i class="material-icons">print</i></button>';       
                     }

                    $btn .= '<a href="' . route('investigationsedit', ['id' => $row->id]) . '"  target="_self" title="Approve" data-bs-toggle="tooltip" data-bs-placement="top"  class="icon-button btn btn-info btn-sm mr-1 editbtn"><i class="material-icons">visibility</i></</a>';
                
                    return $btn;
                })
                ->rawColumns(['crimemain',  'crime','approve_status', 'action'])
                ->make(true);
        }
    }

    public function viewforapprove($investigationID)
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
        $investigationcolse = Crime_investigation_closing::where('investigation_id', $investigationID)->first();
        $suspects = CrimeDetails::where('investigation_id', $investigationID)->where('status', 1)
        ->with(['suspect' => function ($query) { $query->select('id', 'idcardno', 'fullname'); }])->get();

        $crimenotes = DB::table('crime_investigation_notes')
                        ->join('investigation_evidences', 'crime_investigation_notes.id', '=', 'investigation_evidences.investigation_note_id')
                        ->select(
                            'crime_investigation_notes.*',
                            'investigation_evidences.id as evidence_id', 
                            'investigation_evidences.evidence', 
                            'investigation_evidences.evidence_title', 
                            'investigation_evidences.evidence_desription', 
                            'investigation_evidences.status as evidence_status',
                            'investigation_evidences.created_at as evidence_created_at',
                            'investigation_evidences.updated_at as evidence_updated_at'
                        )
                        ->where('crime_investigation_notes.investigation_id', $investigationID)
                        ->where('crime_investigation_notes.status', 1)
                        ->get();


        
    
           return view('Investigations.Closed_Investigation.view_closedinvestigation', compact('policedivisions','maincrimecategory','officers',
        'stations','investigationinfo','victims','divisionID','crimelists','crimenotes','suspects','investigationcolse')); 

    }

    public function approveclosing($investigationID)
    {
        $details = investigation_details::findOrFail($investigationID);
        $details->approve_status = 1;
        $details->approved_by = Auth::id();
        $details->save();

        $closing = Crime_investigation_closing::where('investigation_id', $investigationID)->where('status', 1)->first();
    
        if ($closing) {
            $closing->approved_status = 1;
            $closing->approved_by = Auth::id();
            $closing->save();
        }

        $message = 'Investigation Closing Approved Successfully';
        return redirect()->route('closedinvestigations')->with('message', $message);
    }


}
