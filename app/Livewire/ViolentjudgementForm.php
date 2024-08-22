<?php

namespace App\Livewire;

use App\Models\Crimelist;
use App\Models\policestations;
use Livewire\Component;

class ViolentjudgementForm extends Component
{
    public function render()
    {
        $crimelist = Crimelist::where('category_id', 3)->get();
        $stationlist = policestations::where('status', 1)->get();
        return view('livewire.criminal_forms.violentjudgement-form', compact('crimelist','stationlist'));
    }
}
