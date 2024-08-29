<?php

namespace App\Http\Controllers;

use App\Models\CourtVerdicts;
use App\Models\CrimeDetails;
use App\Models\Crimelist;
use App\Models\policestations;
use App\Models\Suspect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CriminalviolentController extends Controller
{
    public function index(){
       
        $crimelist = Crimelist::where('category_id', 3)->get();
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

                    $btn .= '<button class="btn btn-success btn-sm mr-1 report-btn" id="' . $row->id . '" title="Crime Details" data-bs-toggle="tooltip" data-bs-placement="top"><i class="material-icons">post_add</i></button>';    
                
                    $btn .= '<a href="' . route('suspectsedit', ['id' => $row->id]) . '"  target="_self" title="View" data-bs-toggle="tooltip" data-bs-placement="top"  class="icon-button btn btn-sm mr-1 editbtn"><i class="material-icons">visibility</i></a>';

                    $btn .= '<button class="btn btn-danger btn-sm mr-1 judment-btn" id="' . $row->id . '" title="Court Decision" data-bs-toggle="tooltip" data-bs-placement="top"><i class="fas fa-gavel navfasicon"></i></button>';    

                    return $btn;
                })
                ->rawColumns(['maincategory', 'station', 'crimecategory', 'action'])
                ->make(true);
        }

        return view('Criminals.Criminal_violent.criminalviolent');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'arretedcrime' => 'required',
            'arrestedstation' => 'required',
            'arresteddate' => 'required|date',
            'incidentlocation' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'incidentdate' => 'required|date',
            'incidentnote' => 'nullable|string|max:1000',
            'incidentfalowup' => 'nullable|string|max:1000',
            'incidentevedance' => 'nullable|max:2048', 
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'error',
                'errors' => $validator->errors(),
            ];
        }

        $keywords = $request->incidentdate . ' ' . $request->incidentlocation . ' ' . $request->city;

        if ($request->hasFile('incidentevedance')) {

            $file = $request->file('incidentevedance');
             $currentDate = now()->format('Ymd');
             $renamedFileName = "{$currentDate}_{$request->recordID}_3_{$request->arretedcrime}." . $file->getClientOriginalExtension();
             $file->storeAs('Evedances', $renamedFileName, 'public');
        }
        
          CrimeDetails::create([
            'Keywords' =>  $keywords,
            'arrested_crime_category' => 3,
            'arrested_crime' => $request->arretedcrime,
            'arrested_station' => $request->arrestedstation,
            'suspect_id' => $request->recordID,
            'investigation_id' => null,
            'arrested_date' => $request->arresteddate,
            'incident_location' => $request->incidentlocation,
            'incident_city' => $request->city,
            'dateofincident' => $request->incidentdate,
            'incident_note' => $request->incidentnote,
            'incident_followup' => $request->incidentfalowup,
            'incident_evidance' => $renamedFileName,
            'status' => 1,
            'approve_status' => 0,
            'created_by' => Auth::id(),
            'updated_by' => null,
            'approved_by' => null,
        ]);

        $message = 'Police Station Created Successfully.';

        return redirect()->back()->with('message', $message);
    }

    public function crimeverdict (Request $request)
    {
        $validator = Validator::make($request->all(),[
            'arrestedcrime' => 'required',
            'arrestedpolice' => 'required',
            'arresteddate' => 'required|date',
            'datejudgement' => 'required|string|max:255',
            'judgement' => 'required',
            'penelty' => 'nullable|string|max:255',
            'incidentnote' => 'nullable|string|max:1000',
            'crimerecordID' => 'required',
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'error',
                'errors' => $validator->errors(),
            ];
        }

        $judgestatus= null;

        if($request->judgement === "Not Guilty"){
            $judgestatus = 2;
        }else{

            $judgestatus = 1;
        }

        CourtVerdicts::create([
            'suspect_id' => $request->recordID,
            'crimedetails_id' => $request->crimerecordID,
            'investigation_id' => null,
            'dateofjudgement' => $request->datejudgement,
            'verdict' => $request->judgement,
            'penelty' => $request->penelty,
            'judgment_summary' => $request->incidentnote,
            'status' => 1,
            'created_by' => Auth::id(),
            'updated_by' => null,
        ]);

        $suspect = Suspect::findOrFail($request->recordID);
        $suspect->convictedstatus = $judgestatus;
        $suspect->updated_by = Auth::id();
        $suspect->save();

        $message = 'Suspect Crime Verdict Addedd Successfully.';

        return redirect()->back()->with('message', $message);

    }
   

}
