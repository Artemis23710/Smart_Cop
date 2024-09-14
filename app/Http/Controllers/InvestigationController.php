<?php

namespace App\Http\Controllers;

use App\Models\Maincrimecategory;
use App\Models\Officers;
use App\Models\PoliceDivision;
use App\Services\InvestigationService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class InvestigationController extends Controller
{
    protected $invetigationservice;

    public function __construct(InvestigationService $invetigationservice)
    {
        $this->invetigationservice = $invetigationservice;
    }

    public function index(){
        return view('Investigations.New_Investigation.investigation');
    }

    public function newinvestigation()
    {
        $policedivisions = PoliceDivision::all();
        $maincrimecategory = Maincrimecategory::all();
        $officers = Officers::where('status',1)->get();

        // generate case no
        $currentYear = Carbon::now()->year;
        $lastRecord = DB::table('investigation_details')->orderBy('id', 'desc')->first();
        $newId = $lastRecord ? $lastRecord->id + 1 : 1;
        $newCaseNo = str_pad($newId, 4, '0', STR_PAD_LEFT);
        $caseNo = "ICN-{$currentYear}-{$newCaseNo}";


        return view('Investigations.New_Investigation.new_investigation', compact('policedivisions','maincrimecategory','officers','caseNo'));  
    }

    public function store(Request $request, InvestigationService $invetigationservice)
    {
        $massage = $invetigationservice->store($request);
        return redirect()->route('investigations')->with('message', $massage);
    }


    
}
