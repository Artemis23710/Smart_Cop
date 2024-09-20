<?php

namespace App\Http\Controllers;

use App\Models\investigation_details;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ClosedinvestigationController extends Controller
{
    public function index(){
        return view('Investigations.Closed_Investigation.closedinvestigation');
    }

    public function showclosedinvestigations(Request $request)
    {
        if ($request->ajax()) {

            $data = investigation_details::with(['crimemain','crime'])
                            ->whereIn('investigation_details.status', [1, 2])
                            ->where('investigation_details.investigation_status', 1)
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
                        $btn .= '<a href="' . route('investigationsedit', ['id' => $row->id]) . '"  target="_self" title="Edit" data-bs-toggle="tooltip" data-bs-placement="top"  class="icon-button btn btn-info btn-sm mr-1 editbtn"><i class="material-icons">edit</i></a>';
                    }
                   
                    if (auth()->user()->can('Investigation-Delete')) {
                        $btn .= '<button class="btn btn-danger btn-sm mr-1 delete-btn" data-id="' . $row->id . '" title="Delete" data-bs-toggle="tooltip" data-bs-placement="top"><i class="material-icons">delete</i></button>';
                    }
                    return $btn;
                })
                ->rawColumns(['crimemain',  'crime', 'action'])
                ->make(true);
        }
    }
}
