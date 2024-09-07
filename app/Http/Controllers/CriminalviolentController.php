<?php

namespace App\Http\Controllers;

use App\Models\CourtVerdicts;
use App\Models\CrimeDetails;
use App\Models\Crimelist;
use App\Models\Maincrimecategory;
use App\Models\PoliceDivision;
use App\Models\policestations;
use App\Models\Suspect;
use App\Models\Suspectphoto;
use App\Services\CriminalViolentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CriminalviolentController extends Controller
{
    protected $criminalViolentService;

    public function __construct(CriminalViolentService $criminalViolentService)
    {
        $this->criminalViolentService = $criminalViolentService;

    }


    public function index(){
       
        $crimelist = Crimelist::all();
        $stationlist = policestations::where('status', 1)->get();
        return view('Criminals.Criminal_violent.criminalviolent',compact('crimelist','stationlist'));
    }

    public function showviolentcriminal(Request $request)
    {
        if ($request->ajax()) {

            $data = Suspect::with(['station', 'maincategory','crimecategory'])
                            ->whereIn('suspects.status', [1, 2])
                            ->where('suspects.maincategoryid', 3)
                            ->where('suspects.convictedstatus', 0)
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
                    if (auth()->user()->can('Violent-Crime_details-Add')) {
                        $btn .= '<button class="btn btn-success btn-sm mr-1 report-btn" id="' . $row->id . '" title="Crime Details" data-bs-toggle="tooltip" data-bs-placement="top"><i class="material-icons">post_add</i></button>';    
                    }

                    $btn .= '<a href="' . route('criminalviolentview', ['id' => $row->id]) . '"  target="_self" title="View" data-bs-toggle="tooltip" data-bs-placement="top"  class="icon-button btn btn-sm mr-1 btn-info editbtn"><i class="material-icons">visibility</i></a>';

                    if (auth()->user()->can('Violent-Crime_Judgement-Add')) {

                        $btn .= '<button class="btn btn-danger btn-sm mr-1 judment-btn" id="' . $row->id . '" title="Court Decision" data-bs-toggle="tooltip" data-bs-placement="top"><i class="fas fa-gavel navfasicon"></i></button>';       
                    }

                    return $btn;
                })
                ->rawColumns(['maincategory', 'station', 'crimecategory', 'action'])
                ->make(true);
        }

        return view('Criminals.Criminal_violent.criminalviolent');
    }

    public function store(Request $request,  CriminalViolentService $criminalViolentService)
    {
        
        $message = $criminalViolentService->store($request);
        return redirect()->back()->with('message', $message);
    }

    public function crimeverdict (Request $request,  CriminalViolentService $criminalViolentService)
    {
        $message = $criminalViolentService->crimeverdict($request);
        return redirect()->back()->with('message', $message);
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
        
        return view('Criminals.Criminal_violent.criminalviolenceview', compact('maincrimecategory','policedivisions','stations','suspectinfo',
                     'suspectphoto','divisionID','crimelists','crimedetails','courtjudements'));

    }


    public function update(Request $request ,  CriminalViolentService $criminalViolentService)
    {
        $message = $criminalViolentService->update($request);
        return redirect()->back()->with('message', $message);
    }

    public function updateCrimeVerdict(Request $request ,  CriminalViolentService $criminalViolentService)
    {
        $message = $criminalViolentService->updateCrimeVerdict($request);
        return redirect()->back()->with('message', $message);
    }




    // Commen Functions to all 4 Categories

    public function deletecrimedetails($requestid){

            $details = CrimeDetails::findOrFail($requestid);
            $details->status = 3;
            $details->updated_by = Auth::id();
            $details->save();

            $message = 'Crime Details Deleted Successfully';
        return redirect()->back()->with('message', $message);
    }

    public function deletejudgementdetails($requestid)
    {

        $details = CourtVerdicts::findOrFail($requestid);
        $details->status = 3;
        $details->updated_by = Auth::id();
        $details->save();

        $message = 'Suspect Crime Verdict Deleted Successfully';
        return redirect()->back()->with('message', $message);
    }

    public function getCrimeRecords(Request $request)
    {
        $suspectId = $request->input('suspect_id');
        $crimeRecords = DB::table('crime_details')
            ->leftJoin('court_verdicts', 'crime_details.id', '=', 'court_verdicts.crimedetails_id')
            ->leftJoin('crimelists', 'crime_details.arrested_crime', '=', 'crimelists.id')
            ->where('crime_details.suspect_id', $suspectId)
            ->where('crime_details.status', 1)
            ->whereNull('court_verdicts.id')
            ->select('crime_details.id', 'crimelists.crime', 'crime_details.incident_location','crime_details.arrested_date', 'crime_details.investigation_id','crime_details.arrested_crime')
            ->get();
        return response()->json($crimeRecords);
    }

    public function getCrimeDetails($id)
    {
        $crimeDetails = CrimeDetails::find($id);
    
        if ($crimeDetails) {
            return response()->json([
                'incident_location' => $crimeDetails->incident_location,
                'incident_city' => $crimeDetails->incident_city,
                'dateofincident' => $crimeDetails->dateofincident,
                'incident_note' => $crimeDetails->incident_note,
                'incident_followup' => $crimeDetails->incident_followup,
                'investigation_id' => $crimeDetails->investigation_id,
                'suspect_id' => $crimeDetails->suspect_id,
                'arrested_date' => $crimeDetails->arrested_date,
                'arrested_crime_category' => $crimeDetails->arrested_crime_category,
                'arrested_crime' => $crimeDetails->arrested_crime,
                'arrested_station' => $crimeDetails->arrested_station
            ]);
        } else {
            return response()->json(['error' => 'Record not found'], 404);
        }
    }

    public function getCrimejudgementDetails($id)
    {
        $crimeverdict = CourtVerdicts::find($id);
    
        if ($crimeverdict) {
            return response()->json([
                'dateofjudgement' => $crimeverdict->dateofjudgement,
                'verdict' => $crimeverdict->verdict,
                'penelty' => $crimeverdict->penelty,
                'judgment_summary' => $crimeverdict->judgment_summary,
                'investigation_id' => $crimeverdict->investigation_id,
                'crimedetails_id' => $crimeverdict->crimedetails_id,
                'suspect_id' => $crimeverdict->suspect_id
            ]);
        } else {
            return response()->json(['error' => 'Record not found'], 404);
        }
    }



}
