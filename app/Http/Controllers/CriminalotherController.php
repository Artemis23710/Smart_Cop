<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use App\Models\CourtVerdicts;
use App\Models\CrimeDetails;
use App\Models\Crimelist;
use App\Models\Maincrimecategory;
use App\Models\PoliceDivision;
use App\Models\policestations;
use App\Models\Suspect;
use App\Models\Suspectphoto;
use App\Services\CriminalOtherService;
use App\Services\CriminalViolentService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CriminalotherController extends Controller
{
    protected $CriminalOtherService;

    public function __construct(CriminalOtherService $CriminalOtherService )
    {
         $this->CriminalOtherService = $CriminalOtherService;

    }

    public function index(){
        $crimelist = Crimelist::all();
        $stationlist = policestations::where('status', 1)->get();
        return view('Criminals.Criminal_other.criminalother',compact('crimelist','stationlist'));
    }

    public function showothercriminal(Request $request)
    { 
        if ($request->ajax()) {

            $data = Suspect::with(['station', 'maincategory','crimecategory'])
                            ->whereIn('suspects.status', [1, 2])
                            ->where('suspects.maincategoryid', 4)
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
                    
                    if (auth()->user()->can('Other-Crime_details-Add')) {
                        $btn .= '<button class="btn btn-success btn-sm mr-1 report-btn" id="' . $row->id . '" title="Crime Details" data-bs-toggle="tooltip" data-bs-placement="top"><i class="material-icons">post_add</i></button>';    
                    }

                    $btn .= '<a href="' . route('criminalotherview', ['id' => $row->id]) . '"  target="_self" title="View" data-bs-toggle="tooltip" data-bs-placement="top"  class="icon-button btn btn-sm mr-1 btn-info editbtn"><i class="material-icons">visibility</i></a>';

                    if (auth()->user()->can('Other-Crime_Judgement-Add')) {

                        $btn .= '<button class="btn btn-danger btn-sm mr-1 judment-btn" id="' . $row->id . '" title="Court Decision" data-bs-toggle="tooltip" data-bs-placement="top"><i class="fas fa-gavel navfasicon"></i></button>';       
                    }

                    $btn .= '</td>';

                    return $btn;
                })
                ->rawColumns(['maincategory', 'station', 'crimecategory', 'action'])
                ->make(true);
        }

        return view('Criminals.Criminal_other.criminalother');
    }

    public function store(Request $request,  CriminalOtherService $CriminalOtherService)
    {
        
        $message = $CriminalOtherService->store($request);
        return redirect()->back()->with('message', $message);
    }

    public function crimeverdict (Request $request,  CriminalOtherService $CriminalOtherService)
    {
        $message = $CriminalOtherService->crimeverdict($request);
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
        
        return view('Criminals.Criminal_other.criminalotherview', compact('maincrimecategory','policedivisions','stations','suspectinfo',
                     'suspectphoto','divisionID','crimelists','crimedetails','courtjudements'));

    }

    public function update(Request $request ,  CriminalOtherService $CriminalOtherService)
    {
        $message = $CriminalOtherService->update($request);
        return redirect()->back()->with('message', $message);
    }

    public function updateotherCrimeVerdict(Request $request)
    {
        $message = $this->CriminalOtherService->updateCrimeVerdict($request);

        return redirect()->back()->with('message', $message);
    }



}
