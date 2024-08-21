<?php

namespace App\Http\Controllers;

use App\Models\Crimelist;
use App\Models\Suspect;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CriminalviolentController extends Controller
{
    public function index(){
       
        return view('Criminals.Criminal_violent.criminalviolent');
    }

    public function showviolentcriminal(Request $request)
    {
        if ($request->ajax()) {

            $data = Suspect::with(['station', 'maincategory','crimecategory'])
                            ->whereIn('suspects.status', [1, 2])
                            ->where('suspects.maincategoryid', 3)
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
}
