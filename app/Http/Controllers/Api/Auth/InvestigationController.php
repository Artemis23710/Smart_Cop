<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\investigation_details;

class InvestigationController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $investigations = investigation_details::with(['crimemain','crime'])
        ->where(function($query) use ($keyword) {
            $query->where('Keywords', 'like', '%' . $keyword . '%')
                  ->orWhere('case_no', 'like', '%' . $keyword . '%')
                  ->orWhere('title_incident', 'like', '%' . $keyword . '%')
                  ->orWhere('incident_date', 'like', '%' . $keyword . '%')
                  ->orWhere('incident_location', 'like', '%' . $keyword . '%')
                  ->orWhere('incident_area', 'like', '%' . $keyword . '%');
        })
        ->whereIn('status', [1, 2])
        ->get();

        $data = array(
            'investigationlist' => $investigations
        );
        return (new BaseController)->sendResponse($data, 'investigationlist');
    }

    
}
