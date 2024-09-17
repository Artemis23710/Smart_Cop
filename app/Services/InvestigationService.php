<?php

namespace App\Services;

use App\Models\Crimelist;
use App\Models\investigation_details;
use App\Models\investigation_vicims;
use App\Models\policestations;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class InvestigationService
{
    
    public function store($request){

        $validator = Validator::make($request->all(),[
            'caseno' => 'required',
            'reportdate' => 'required',
            'crimecategory' => 'required',
            'arrestedcrime' => 'required',
            'incidenttitle' => 'required|string',
            'incidentdate' => 'required|date',
            'incidentlocation' => 'nullable|string',
            'incidentarea' => 'required|string|max:255',
            'arreststationid' => 'required',
            'officerid' => 'required',
            'officerassigndate' => 'required|date',
            'incidentdescription' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'error',
                'errors' => $validator->errors(),
            ];
        }

        $keywords = $request->caseno . ' ' . $request->incidenttitle . ' ' . $request->incidentlocation. ' ' . $request->incidentarea. ' ' . $request->incidentdate; 

       $investigatation =  investigation_details::create([
            'Keywords' =>  $keywords,
            'case_no' => $request->caseno,
            'report_date' => $request->reportdate,
            'arrested_crime_category' => $request->crimecategory,
            'arrested_crime' => $request->arrestedcrime,
            'title_incident' => $request->incidenttitle,
            'incident_date' => $request->incidentdate,
            'incident_location' => $request->incidentlocation,
            'incident_area' => $request->incidentarea,
            'arrested_station' => $request->arreststationid,
            'investigating_officer' => $request->officerid,
            'assigndate' => $request->officerassigndate,
            'incident_description' => $request->incidentdescription,
            'status' => 1,
            'approve_status' => 0,
            'investigation_status' => 0,
            'created_by' => Auth::id(),
            'updated_by' => null,
            'approved_by' => null,
        ]);

        $savedinvestigationId = $investigatation->id;
        
        $victimNames = $request->input('victimname', []);
        $victimGenders = $request->input('victimgender', []);
        $victimAges = $request->input('victimage', []);
    
        // Ensure all arrays are of the same length
        $victimDataCount = min(count($victimNames), count($victimGenders), count($victimAges));
    
        // Insert victim details
        for ($index = 0; $index < $victimDataCount; $index++) {
            // Ensure data is valid before inserting (skip if necessary data is missing)
            if (!empty($victimNames[$index]) && !empty($victimGenders[$index]) && !empty($victimAges[$index])) {
                investigation_vicims::create([
                    'investigation_id' => $savedinvestigationId,
                    'victim_name' => $victimNames[$index],
                    'victim_gender' => $victimGenders[$index],
                    'victim_age' => $victimAges[$index],
                    'status' => 1,
                ]);
            }
        }


        $message = 'Investigation Details Created Successfully.';
        return  $message;
    }

    public function updateStatus($requestid, $statusid)
    {
     
        $suspect = investigation_details::findOrFail($requestid);
        
        switch ($statusid) {
            case 1:
                $suspect->status = 1;
                $message = 'Investigation Activated Successfully.';
                break;
                
            case 2:
                $suspect->status = 2;
                $message = 'Investigation Deactivated Successfully.';
                break;
                
            default:
                $suspect->status = 3;
                $message = 'Investigation Deleted Successfully.';
                break;
        }
        
        $suspect->updated_by = Auth::id();
        $suspect->save();

        return $message;
    }

}