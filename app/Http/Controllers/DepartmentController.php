<?php

namespace App\Http\Controllers;

use App\Models\Officers;
use Illuminate\Http\Request;
use App\Models\Officerprofilephoto;
use App\Models\OfficerRank;
use App\Models\PoliceDivision;
use App\Models\policestations;

class DepartmentController extends Controller
{
    public function index(){

        return view('Dashboards.departmentdashboard');

    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $officers = Officers::with(['rank', 'station.policedivision'])
        ->where(function($query) use ($keyword) {
            $query->where('Keywords', 'like', '%' . $keyword . '%')
                  ->orWhere('fullname', 'like', '%' . $keyword . '%')
                  ->orWhere('officerid', 'like', '%' . $keyword . '%')
                  ->orWhere('idcardno', 'like', '%' . $keyword . '%');
        })
        ->whereIn('status', [1, 2])
        ->get();
        
        $html = '';
        if ($officers->isNotEmpty()) {
            foreach ($officers as $officer) {
                $html .= '<tr>';
                $html .= '<td>' . $officer->namewithintial . '</td>';
                $html .= '<td>' . $officer->officerid . '</td>';
                $html .= '<td>' . $officer->gender . '</td>';
                $html .= '<td>' . ($officer->rank->Rank_name ?? 'N/A') . '</td>';
                $html .= '<td>' . ($officer->station->policedivision->division_name ?? 'N/A') . '</td>';
                $html .= '<td>' . ($officer->station->station_name ?? 'N/A') . '</td>';
                $html .= '<td>' . $officer->contactno . '</td>';
                $html .= '<td class ="text-right">';

                $html .= '<a href="' . route('viewofficer', ['id' => $officer->id]) . '" target="_self" title="View" data-bs-toggle="tooltip" data-bs-placement="top" class="icon-button btn btn-sm mr-1 viewbtn"> 
                <i class="material-icons">visibility</i></a> &nbsp;';

                
                if (auth()->user()->can('Officer-Edit')) {
                    $html .= '<a href="' . route('offieredit', ['id' => $officer->id]) . '" target="_self" title="Edit" data-bs-toggle="tooltip" data-bs-placement="top" class="icon-button btn btn-info btn-sm mr-1 editbtn"><i class="material-icons">edit</i></a>';
                }


                $html .= '</td>';

                $html .= '</tr>';
            }
        } else {
            $html = '';
        }

        return response()->json(['html' => $html]);
    }

    public function viewofficer($officerID){

        $ranks = OfficerRank::all();
        $policedivisions = PoliceDivision::all();
        $stations = policestations::all();
        $officerinfo = Officers::find($officerID);

        $officerphoto = Officerprofilephoto::where('officer_id', $officerID)->first();

        return view('Department.Officers.viewofficer', compact('ranks','policedivisions','stations','officerinfo','officerphoto'));
    }
    

}
