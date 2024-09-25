<?php

namespace App\Http\Controllers;

use App\Models\Crime_investigation_note;
use App\Models\CrimeDetails;
use App\Models\Crimelist;
use App\Models\investigation_vicims;
use App\Models\Maincrimecategory;
use App\Models\investigation_details;
use App\Models\PoliceDivision;
use App\Models\policestations;
use App\Models\Officers;
use App\Services\InvestigationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class OngoinginvestigationController extends Controller
{

    protected $investigationservice;

    public function __construct(InvestigationService $investigationservice)
    {
        $this->investigationservice = $investigationservice;

    }

    public function index(){
        return view('Investigations.Ongoing_investigations.ongoinginvestigation');
    }

    public function showongoinginvestigations(Request $request)
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

                    if (auth()->user()->can('Investigation-Crime-Note-Add')) {
                        $btn .= '<button class="btn btn-success btn-sm mr-1 incident-btn" id="' . $row->id . '" title="Investigation Note" data-bs-toggle="tooltip" data-bs-placement="top"><i class="material-icons">post_add</i></button>';    
                    }
                   

                    $btn .= '<a href="' . route('ongoinginvestigationview', ['id' => $row->id]) . '"  target="_self" title="View OngoingInvestigation" data-bs-toggle="tooltip" data-bs-placement="top"  class="icon-button btn btn-sm mr-1 btn-info editbtn"><i class="material-icons">visibility</i></a>';

                    if (auth()->user()->can('Investigation-Closing-Add')) {
                       $btn .= '<button class="btn btn-danger btn-sm mr-1 closeinvestigation-btn" id="' . $row->id . '" title="Court Decision" data-bs-toggle="tooltip" data-bs-placement="top">
                       <i class="material-icons">folder_off</i></button>';       
                    }
                    return $btn;
                })
                ->rawColumns(['crimemain',  'crime', 'action'])
                ->make(true);
        }
    }

    public function saveinvestigationnote(Request $request,  InvestigationService $investigationservice)
    {
        $message = $investigationservice->saveinvestigationnote($request);
        return redirect()->route('ongoinginvestigations')->with('message', $message);
    }

    public function saveinvestigationclose(Request $request,  InvestigationService $investigationservice)
    {
        $message = $investigationservice->saveinvestigationclose($request);
        return redirect()->route('ongoinginvestigations')->with('message', $message);
    }

    public function view($investigationID)
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
        $crimenotes = Crime_investigation_note::where('investigation_id', $investigationID)->where('status', 1)->get();
        $suspects = CrimeDetails::where('investigation_id', $investigationID)->where('status', 1)
        ->with(['suspect' => function ($query) {
                              $query->select('id', 'idcardno', 'fullname'); }])->get();


        return view('Investigations.Ongoing_investigations.edit_ongoinginvestigation', compact('policedivisions','maincrimecategory','officers',
        'stations','investigationinfo','victims','divisionID','crimelists','crimenotes','suspects')); 

    }

    public function getCrimeNoteDetails($id)
    {
        $crimeDetails = Crime_investigation_note::find($id);
    
        if ($crimeDetails) {
            return response()->json([
                'investigation_id' => $crimeDetails->investigation_id,
                'investigation_title' => $crimeDetails->investigation_title,
                'day_investigation_note' => $crimeDetails->day_investigation_note,
                'related_location' => $crimeDetails->related_location,
                'description' => $crimeDetails->description
            ]);
        } else {
            return response()->json(['error' => 'Record not found'], 404);
        }
    }

    public function updateinvestigationnote(Request $request,  InvestigationService $investigationservice)
    {
        $message = $investigationservice->updateinvestigationnote($request);
        return redirect()->back()->with('message', $message);
    }

    public function deleteinvestigationnote($requestid)
    {
        $details = Crime_investigation_note::findOrFail($requestid);
        $details->status = 3;
        $details->updated_by = Auth::id();
        $details->save();
        $message = 'Investigation Crime Note Deleted Successfully';
        return redirect()->back()->with('message', $message);
    }

    

}
