<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PoliceDivision;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class OthercomplainsController extends Controller
{
    public function index(){
        return view('Complains.Othercomplains.complains');
    }

    public function newothercomplains()
    {
        $policedivisions = PoliceDivision::all();

        $currentYear = Carbon::now()->year;
        $lastRecord = DB::table('investigation_details')->orderBy('id', 'desc')->first();
        $newId = $lastRecord ? $lastRecord->id + 1 : 1;
        $newCaseNo = str_pad($newId, 4, '0', STR_PAD_LEFT);
        $caseNo = "ICN-{$currentYear}-{$newCaseNo}";
        
        return view('Complains.Othercomplains.newothercomplaints', compact('policedivisions','caseNo'));  
    }
}
