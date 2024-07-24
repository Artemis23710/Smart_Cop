<?php

namespace App\Livewire;

use App\Models\policestations;
use Livewire\Component;

class PoliceStationTable extends Component
{
    public $stations;

    public function mount()
    {
        $this->stations = policestations::with(['policedivision.district']) 
        ->whereIn('policestations.status', [1, 2])
        ->get();
    }

    public function render()
    {
        return view('livewire.Department_Tables.police-station-table');
    }
}
