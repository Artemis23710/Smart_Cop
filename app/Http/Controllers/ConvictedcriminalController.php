<?php

namespace App\Http\Controllers;

use App\Models\CourtVerdicts;
use App\Models\CrimeDetails;
use App\Models\Maincrimecategory;
use App\Models\PoliceDivision;
use App\Models\Suspectphoto;
use App\Models\Crimelist;
use App\Models\investigation_details;
use App\Models\policestations;
use App\Models\Suspect;
use App\Services\CriminalSeriousService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ConvictedcriminalController extends Controller
{
    public function index(){
        return view('Criminals.Convicted.convictedcriminal');
    }
    public function showconvictedcriminals(Request $request)
    {
        if ($request->ajax()) {

            $data = Suspect::with(['station', 'maincategory','crimecategory'])
                            ->whereIn('suspects.status', [1, 2])
                            ->where('suspects.convictedstatus', 1)
                            ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('maincategory', function($row){
                    return $row->maincategory->main_crime_category ?? 'N/A';
                })
                ->addColumn('station', function($row){
                    return $row->station->station_name ?? 'N/A';
                })
                ->addColumn('crimecategory', function($row){
                    return $row->crimecategory->crime ?? 'N/A';
                })

                ->addColumn('action', function($row) {
                    $btn = '<td class="text-right">';
                    if (auth()->user()->can('Convicted-Criminals-Print')) {

                        $btn .= '<button class="btn btn-danger btn-sm mr-1 printdocuments-btn" id="' . $row->id . '" title="Print Details" data-bs-toggle="tooltip" data-bs-placement="top"><i class="material-icons">print</i></button>';       
                     }

                    $btn .= '<a href="' . route('convictedcriminalsview', ['id' => $row->id]) . '"  target="_self" title="Approve" data-bs-toggle="tooltip" data-bs-placement="top"  class="icon-button btn btn-info btn-sm mr-1 editbtn"><i class="material-icons">visibility</i></</a>';

                    $btn .= '</td>';

                    return $btn;
                })
                ->rawColumns(['maincategory', 'station', 'crimecategory', 'action'])
                ->make(true);
        }

        return view('Criminals.Convicted.convictedcriminal');
    }

    public function View($suspectID)
    {
        $policedivisions = PoliceDivision::all();
        $maincrimecategory = Maincrimecategory::all();
        $stations = policestations::all();
        $suspectinfo = Suspect::find($suspectID);
        $suspectphoto = Suspectphoto::where('suspect_id', $suspectID)->first();

        $stationID = $suspectinfo->stationid;
        $station = policestations::find($stationID);
        $divisionID = $station ? $station->division_id : null;

        $categoryID = $suspectinfo->maincategoryid;
        $crimelists = Crimelist::where('category_id', $categoryID)->get();

        $crimedetails = CrimeDetails::where('suspect_id', $suspectID)->where('status', 1)->get();
        $courtjudements = CourtVerdicts::where('suspect_id', $suspectID)->where('status', 1)->get();
        $investigationlist = investigation_details::where('status', 1)->where('investigation_status', 0)->get();
        
        return view('Criminals.Convicted.convictedcriminalview', compact('maincrimecategory','policedivisions','stations','suspectinfo',
                     'suspectphoto','divisionID','crimelists','crimedetails','courtjudements','investigationlist'));

    }
}
