<?php

namespace App\Http\Controllers;

use App\Models\investigation_details;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OngoinginvestigationController extends Controller
{
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

                    if (auth()->user()->can('Investigation-Edit')) {
                        $btn .= '<button class="btn btn-success btn-sm mr-1 report-btn" id="' . $row->id . '" title="Investigation Note" data-bs-toggle="tooltip" data-bs-placement="top"><i class="material-icons">post_add</i></button>';    
                    }
                   

                    $btn .= '<a href="' . route('criminalseriousview', ['id' => $row->id]) . '"  target="_self" title="View Investigation" data-bs-toggle="tooltip" data-bs-placement="top"  class="icon-button btn btn-sm mr-1 btn-info editbtn"><i class="material-icons">visibility</i></a>';

                    if (auth()->user()->can('Investigation-Delete')) {
                       $btn .= '<button class="btn btn-danger btn-sm mr-1 judment-btn" id="' . $row->id . '" title="Court Decision" data-bs-toggle="tooltip" data-bs-placement="top">
                       <i class="material-icons">folder_off</i></button>';       
                    }
                    return $btn;
                })
                ->rawColumns(['crimemain',  'crime', 'action'])
                ->make(true);
        }
    }

    
}
