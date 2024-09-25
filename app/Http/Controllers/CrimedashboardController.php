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
use Illuminate\Support\Facades\DB;

class CrimedashboardController extends Controller
{
    public function index(){
        return view('Dashboards.investigationdashboard');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $investigations = investigation_details::with(['crimemain','crime'])
        ->where(function($query) use ($keyword) {
            $query->where('Keywords', 'like', '%' . $keyword . '%')
                  ->orWhere('case_no', 'like', '%' . $keyword . '%')
                  ->orWhere('title_incident', 'like', '%' . $keyword . '%')
                  ->orWhere('incident_date', 'like', '%' . $keyword . '%')
                  ->orWhere('incident_location', 'like', '%' . $keyword . '%')
                  ->orWhere('incident_area', 'like', '%' . $keyword . '%');
        })
        ->whereIn('status', [1, 2])
        ->get();

        $html = '';
        if ($investigations->isNotEmpty()) {
            foreach ($investigations as $investigation) {
                $html .= '<tr>';
                $html .= '<td>' . $investigation->case_no . '</td>';
                $html .= '<td>' . ($investigation->crimemain->main_crime_category ?? 'N/A') . '</td>';
                $html .= '<td>' . ($investigation->crime->crime ?? 'N/A') . '</td>';
                $html .= '<td>' . $investigation->title_incident . '</td>';
                $html .= '<td>' . $investigation->incident_date . '</td>';
                $html .= '<td>' . $investigation->incident_location . '</td>';
                $html .= '<td>' . $investigation->incident_area . '</td>';
                $html .= '<td>' . 
                        ($investigation->investigation_status == 0 ? '<span class="text-danger">Ongoing Investigationd</span>' 
                            : ($investigation->approve_status == 1 ? '<span class="text-success">Closed Investigation</span>' 
                            : '')) . '</td>';
                $html .= '<td class ="text-right">';
                $html .= '<a href="' . route('crimeview', ['id' => $investigation->id]) . '" target="_self" title="View" data-bs-toggle="tooltip" data-bs-placement="top" class="icon-button btn btn-info  btn-sm mr-1 viewbtn"> 
                <i class="material-icons">visibility</i></a> &nbsp;';
                $html .= '</td>';
                $html .= '</tr>';
            }
        } else {
            $html = '';
        }
        return response()->json(['html' => $html]);
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
        $investigationcolse = Crime_investigation_closing::where('investigation_id', $investigationID)->first();
        $suspects = CrimeDetails::where('investigation_id', $investigationID)->where('status', 1)
        ->with(['suspect' => function ($query) { $query->select('id', 'idcardno', 'fullname'); }])->get();

        $crimenotes = DB::table('crime_investigation_notes')
        ->leftJoin('investigation_evidences', 'crime_investigation_notes.id', '=', 'investigation_evidences.investigation_note_id')
        ->select(
            'crime_investigation_notes.*',
            'investigation_evidences.evidence', 
            'investigation_evidences.id as evidence_id',
            'investigation_evidences.evidence_title',
            'investigation_evidences.evidence_desription',
            'investigation_evidences.status as evidence_status'
        )
        ->where('crime_investigation_notes.investigation_id', $investigationID)
        ->where('crime_investigation_notes.status', 1)
        ->orderBy('crime_investigation_notes.id', 'asc') 
        ->get()
        ->groupBy('id');

     return view('Investigations.Search_View.searchinvestigationview', compact('policedivisions','maincrimecategory','officers',
        'stations','investigationinfo','victims','divisionID','crimelists','crimenotes','suspects','investigationcolse')); 
    }
}
