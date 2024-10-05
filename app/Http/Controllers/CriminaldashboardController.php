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
use Illuminate\Http\Request;

class CriminaldashboardController extends Controller
{
    public function index(){
        return view('Dashboards.criminaldashboard');
    }

    public function search(Request $request){
        $keyword = $request->input('keyword');

        $suspects = Suspect::with(['maincategory','crimecategory'])
        ->where(function($query) use ($keyword) {
            $query->where('Keywords', 'like', '%' . $keyword . '%')
                  ->orWhere('idcardno', 'like', '%' . $keyword . '%')
                  ->orWhere('fullname', 'like', '%' . $keyword . '%')
                  ->orWhere('aliases', 'like', '%' . $keyword . '%');
        })
        ->whereIn('status', [1, 2])
        ->get();

        $html = '';
        if ($suspects->isNotEmpty()) {
            foreach ($suspects as $suspect) {

                $html .= '<tr>';
                $html .= '<td>' . $suspect->fullname . '</td>';
                $html .= '<td>' . $suspect->idcardno . '</td>';
                $html .= '<td>' . $suspect->aliases . '</td>';
                $html .= '<td>' . $suspect->gender. '</td>';
                $html .= '<td>' . ($suspect->maincategory->main_crime_category ?? 'N/A') . '</td>';
                $html .= '<td>' . ($suspect->crimecategory->crime ?? 'N/A') . '</td>';
                $html .= '<td>' . $suspect->arresteddate . '</td>';
                $html .= '<td class ="text-right">';

                $html .= '<a href="' . route('criminalview', ['id' => $suspect->id]) . '" target="_self" title="View" data-bs-toggle="tooltip" data-bs-placement="top" class="icon-button btn btn-info  btn-sm mr-1 viewbtn"> 
                <i class="material-icons">visibility</i></a> &nbsp;';
                $html .= '</td>';

                $html .= '</tr>';
            }
        } else {
            $html = '';
        }
        return response()->json(['html' => $html]);
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
        
        return view('Criminals.search_view.criminalsearchview', compact('maincrimecategory','policedivisions','stations','suspectinfo',
                     'suspectphoto','divisionID','crimelists','crimedetails','courtjudements','investigationlist'));

    }



    public function Imagesearch(Request $request)
    {

        $request->validate([
            'criminalimage' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        $image = $request->file('criminalimage');

        $originalFileName = $image->getClientOriginalName();

       $targetPath = public_path('storage/Targetimages');

       $image->move($targetPath, $originalFileName);

        $fullImagePath = $targetPath . '/' . $originalFileName;
        
        $pythonScriptPath = 'C:\xampp 8.2\htdocs\Smart_Cop\FR_module\frodule.py';
        
        $pythonPath = 'C:\Users\janit\PycharmProjects\FR_module\.venv\Scripts\python.exe';

        // Construct the command with proper quoting
        $output = shell_exec("\"$pythonPath\" \"$pythonScriptPath\" \"$fullImagePath\" 2>&1");


        dd($output);

        if (trim($output) === "No match found") {
            return view('Dashboards.criminaldashboard');
        }

    }
}
