<?php

namespace App\Services;

use App\Models\Crimelist;
use App\Models\policestations;
use App\Models\Suspect;
use App\Models\CrimeDetails;
use App\Models\CourtVerdicts;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class CriminaFinanceService
{

    
    public function store($request)
    {

        $validator = Validator::make($request->all(),[
            'reletedinvestigation' => 'required',
            'arretedcrime' => 'required',
            'arrestedstation' => 'required',
            'arresteddate' => 'required|date',
            'incidentlocation' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'incidentdate' => 'required|date',
            'incidentnote' => 'nullable|string|max:1000',
            'incidentfalowup' => 'nullable|string|max:1000',
            'incidentevedance' => 'nullable|max:2048', 
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'error',
                'errors' => $validator->errors(),
            ];
        }

        $keywords = $request->incidentdate . ' ' . $request->incidentlocation . ' ' . $request->city;

        if ($request->hasFile('incidentevedance')) {

            $file = $request->file('incidentevedance');
             $currentDate = now()->format('Ymd');
             $renamedFileName = "{$currentDate}_{$request->recordID}_2_{$request->arretedcrime}." . $file->getClientOriginalExtension();
             $file->storeAs('Evedances', $renamedFileName, 'public');
        }
        
          CrimeDetails::create([
            'Keywords' =>  $keywords,
            'arrested_crime_category' => 2,
            'arrested_crime' => $request->arretedcrime,
            'arrested_station' => $request->arrestedstation,
            'suspect_id' => $request->recordID,
            'investigation_id' => $request->reletedinvestigation,
            'arrested_date' => $request->arresteddate,
            'incident_location' => $request->incidentlocation,
            'incident_city' => $request->city,
            'dateofincident' => $request->incidentdate,
            'incident_note' => $request->incidentnote,
            'incident_followup' => $request->incidentfalowup,
            'incident_evidance' => $renamedFileName,
            'status' => 1,
            'approve_status' => 0,
            'created_by' => Auth::id(),
            'updated_by' => null,
            'approved_by' => null,
        ]);

        $message = 'Crime Details Created Successfully.';
        return  $message;

    }

    public function crimeverdict($request)
    {
        $validator = Validator::make($request->all(),[
            'arrestedcrime' => 'required',
            'datejudgement' => 'required|string|max:255',
            'judgement' => 'required',
            'penelty' => 'nullable|string|max:255',
            'incidentnote' => 'nullable|string|max:1000',
            'crimerecordID' => 'required',
            'reletedinvestigation' => 'required',
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'error',
                'errors' => $validator->errors(),
            ];
        }


        $judgestatus= null;

        $judgestatus = ($request->judgement === "Not Guilty") ? 2 : 1;

        CourtVerdicts::create([
            'suspect_id' => $request->recordID,
            'crimedetails_id' => $request->crimerecordID,
            'investigation_id' =>  $request->reletedinvestigation,
            'dateofjudgement' => $request->datejudgement,
            'verdict' => $request->judgement,
            'penelty' => $request->penelty,
            'judgment_summary' => $request->incidentnote,
            'status' => 1,
            'created_by' => Auth::id(),
            'updated_by' => null,
        ]);

        $suspect = Suspect::findOrFail($request->recordID);

        $crimeRecordWithoutVerdict = DB::table('crime_details')
                ->leftJoin('court_verdicts', 'crime_details.id', '=', 'court_verdicts.crimedetails_id')
                ->where('crime_details.suspect_id', $request->recordID)
                ->where('crime_details.status', 1)
                ->whereNull('court_verdicts.id')
                ->select('crime_details.*')
                ->first();

        if ($crimeRecordWithoutVerdict) {
            $suspect->stationid = $crimeRecordWithoutVerdict->arrested_station;
            $suspect->maincategoryid = $crimeRecordWithoutVerdict->arrested_crime_category;
            $suspect->crimeid = $crimeRecordWithoutVerdict->arrested_crime;
            $suspect->arresteddate = $crimeRecordWithoutVerdict->arrested_date;
        }else{
            $suspect->convictedstatus = $judgestatus;
            $suspect->updated_by = Auth::id();
        }

              $suspect->save();

        $message = 'Suspect Crime Verdict Addedd Successfully.';
        return  $message;

    }

     public function update($request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'incidentlocation' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'incidentdate' => 'required|date',
            'incidentnote' => 'nullable|string|max:1000',
            'incidentfalowup' => 'nullable|string|max:1000',
            'incidentevedance' => 'nullable|max:2048', 
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'error',
                'errors' => $validator->errors(),
            ];
        }

        $id = $request->recordID;
        $crimeDetails = CrimeDetails::findOrFail($id);

        $keywords = $request->incidentdate . ' ' . $request->incidentlocation . ' ' . $request->city;

        if ($request->hasFile('incidentevedance')) {
            $file = $request->file('incidentevedance');
            $currentDate = now()->format('Ymd');
            $renamedFileName = "{$currentDate}_{$request->recordID}_2_{$request->arretedcrime}." . $file->getClientOriginalExtension();
            $file->storeAs('Evedances', $renamedFileName, 'public');

            if ($crimeDetails->incident_evidance) {
                Storage::disk('public')->delete('Evedances/' . $crimeDetails->incident_evidance);
            }
            $crimeDetails->incident_evidance = $renamedFileName;
        }

        $crimeDetails->update([
            'Keywords' => $keywords,
            'incident_location' => $request->incidentlocation,
            'incident_city' => $request->city,
            'dateofincident' => $request->incidentdate,
            'incident_note' => $request->incidentnote,
            'incident_followup' => $request->incidentfalowup,
            'updated_by' => Auth::id()
        ]);

        $message = 'Crime Details Updated Successfully.';
        return $message;
    }

    public function updateCrimeVerdict($request)
    {

        $validator = Validator::make($request->all(), [
            'datejudgement' => 'required|string|max:255',
            'judgement' => 'required',
            'penelty' => 'nullable|string|max:255',
            'judgementnote' => 'nullable|string|max:1000',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $judgestatus = $request->judgement === "Not Guilty" ? 2 : 1;
    
        // Find the CourtVerdict record and update it
        $id = $request->recordID;
        $courtVerdict = CourtVerdicts::findOrFail($id);
    
        $courtVerdict->update([
            'dateofjudgement' => $request->datejudgement,
            'verdict' => $request->judgement,
            'penelty' => $request->penelty,
            'judgment_summary' => $request->judgementnote,
            'updated_by' => Auth::id(),
        ]);
    
        $suspect = Suspect::findOrFail($request->recordID);
    
        $crimeRecordWithoutVerdict = DB::table('crime_details')
            ->leftJoin('court_verdicts', 'crime_details.id', '=', 'court_verdicts.crimedetails_id')
            ->where('crime_details.suspect_id', $request->recordID)
            ->where('crime_details.status', 1)
            ->whereNull('court_verdicts.id')
            ->select('crime_details.*')
            ->first();
    
        if ($crimeRecordWithoutVerdict) {
            $suspect->stationid = $crimeRecordWithoutVerdict->arrested_station;
            $suspect->maincategoryid = $crimeRecordWithoutVerdict->arrested_crime_category;
            $suspect->crimeid = $crimeRecordWithoutVerdict->arrested_crime;
            $suspect->arresteddate = $crimeRecordWithoutVerdict->arrested_date;
        } else {
            $suspect->convictedstatus = $judgestatus;
            $suspect->updated_by = Auth::id();
        }
    
        $suspect->save();
    
        return 'Suspect Crime Verdict Updated Successfully.';
    }
    

}