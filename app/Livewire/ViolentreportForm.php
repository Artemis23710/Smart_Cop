<?php

namespace App\Livewire;

use App\Models\CrimeDetails;
use App\Models\Crimelist;
use App\Models\policestations;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
class ViolentreportForm extends Component
{
    use WithFileUploads;

    public $arretedcrime;
    public $arrestedstation;
    public $investigation_id;
    public $arresteddate;
    public $incidentlocation;
    public $city;
    public $incidentdate;
    public $incidentnote;
    public $incidentfalowup;
    public $incidentevedance;
    public $recordID;
    

    
    protected $rules = [
        'arretedcrime' => 'required',
        'arrestedstation' => 'required',
        'arresteddate' => 'required|date',
        'incidentlocation' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'incidentdate' => 'required|date',
        'incidentnote' => 'nullable|string|max:1000',
        'incidentfalowup' => 'nullable|string|max:1000',
        'incidentevedance' => 'nullable|max:2048', 
        'recordID' => 'required' 
    ];

    protected $listeners = ['setRecordID'];
    public function setRecordID($id)
    {
        $this->recordID = $id;
    }

    
    public function render()
    {
        $crimelist = Crimelist::where('category_id', 3)->get();
        $stationlist = policestations::where('status', 1)->get();
        return view('livewire.criminal_forms.violentreport-form', compact('crimelist','stationlist'));
    }

    public function saveCrimeRecord()
    {
         dd($this->recordID);
        $this->validate();
        $renamedFileName = null;

        if ($this->incidentevedance) {

            $file = $this->incidentevedance;
             $currentDate = now()->format('Ymd');
             $renamedFileName = "{$currentDate}_{$this->recordID}_3_{$this->arretedcrime}." . $file->getClientOriginalExtension();
             $file->storeAs('Evedances', $renamedFileName, 'public');
        }

        $keywords = $this->incidentdate . ' ' . $this->incidentlocation . ' ' . $this->city;

        CrimeDetails::create([
            'Keywords' =>  $keywords,
            'arrested_crime_category' => 3,
            'arrested_crime' => $this->arretedcrime,
            'arrested_station' => $this->arrestedstation,
            'suspect_id' => $this->recordID,
            'investigation_id' => null,
            'arrested_date' => $this->arresteddate,
            'incident_location' => $this->incidentlocation,
            'incident_city' => $this->city,
            'dateofincident' => $this->incidentdate,
            'incident_note' => $this->incidentnote,
            'incident_followup' => $this->incidentfalowup,
            'incident_evidance' => $renamedFileName,
            'status' => 1,
            'approve_status' => 0,
            'created_by' => Auth::id(),
            'updated_by' => null,
            'approved_by' => null,
        ]);

        session()->flash('message', 'Crime record has been saved successfully.');

        return redirect()->route('criminalviolent'); 
    }
}
