<?php

namespace App\Http\Controllers;

use App\Models\Crimelist;
use App\Models\Maincrimecategory;
use App\Models\PoliceDivision;
use App\Models\policestations;
use App\Models\Suspect;
use App\Models\Suspectphoto;
use App\Services\SuspectService;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class SuspectController extends Controller
{
    protected $suspectservice;

    public function __construct(SuspectService $suspectservice)
    {
        $this->suspectservice = $suspectservice;
    }

    public function index(){
        return view('Criminals.Suspects.suspects');
    }

    public function newsuspect(){
        $policedivisions = PoliceDivision::all();
        $maincrimecategory = Maincrimecategory::all();
        return view('Criminals.Suspects.newsuspects', compact('policedivisions','maincrimecategory'));  
    }

    public function getcrime($maincategoryID)
    {
        $crimelist = Crimelist::where('category_id', $maincategoryID)->get();
        return response()->json($crimelist);
    }

    public function showsuspects(Request $request)
    {
        if ($request->ajax()) {

            $data = Suspect::with(['station', 'maincategory','crimecategory'])
                            ->whereIn('suspects.status', [1, 2])
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
                    
                    if (auth()->user()->can('Suspect-Edit')) {
                        $btn .= '<a href="' . route('suspectsedit', ['id' => $row->id]) . '"  target="_self" title="Edit" data-bs-toggle="tooltip" data-bs-placement="top"  class="icon-button btn btn-info btn-sm mr-1 editbtn"><i class="material-icons">edit</i></a>';
                    }

                    if (auth()->user()->can('Suspect-Status')) {
                        if ($row->status == 1) {
                            $btn .= '<a href="' . route('suspectstatus', ['id' => $row->id, 'status' => 2]) . '" onclick="return deactive_confirm()" target="_self" title="Deactivate" data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-success btn-sm mr-1"><i class="fas fa-check"></i></a>';
                        } else {
                            $btn .= '<a href="' . route('suspectstatus', ['id' => $row->id, 'status' => 1]) . '" onclick="return active_confirm()" target="_self" title="Activate" data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-warning btn-sm mr-1"><i class="fas fa-times"></i></a>';
                        }
                    }

                    if (auth()->user()->can('Suspect-Delete')) {
                        $btn .= '<button class="btn btn-danger btn-sm mr-1 delete-btn" data-id="' . $row->id . '" title="Delete" data-bs-toggle="tooltip" data-bs-placement="top"><i class="material-icons">delete</i></button>';
                    }
                
                    $btn .= '</td>';

                    return $btn;
                })
                ->rawColumns(['maincategory', 'station', 'crimecategory', 'action'])
                ->make(true);
        }

        return view('Criminals.Suspects.suspects');
    }

    public function store(Request $request, SuspectService $suspectservice)
    {
        $result = $suspectservice->store($request);
            if ($result['status'] === 'success') {
                return redirect()->route('suspects')->with('message', $result['message']);
            }
            return redirect()->back()->withErrors($result['errors'])->withInput();
    }

    public function edit($officerID)
    {
        $policedivisions = PoliceDivision::all();
        $maincrimecategory = Maincrimecategory::all();
        $stations = policestations::all();
        $suspectinfo = Suspect::find($officerID);
        $suspectphoto = Suspectphoto::where('suspect_id', $officerID)->first();

        return view('Criminals.Suspects.editsuspects', compact('maincrimecategory','policedivisions','stations','suspectinfo','suspectphoto'));

    }

    public function status($requestid, $statusid)
    {
        $message = $this->suspectservice->updateStatus($requestid, $statusid);
        return redirect()->back()->with('message', $message);
    }

}
