<?php

namespace App\Livewire;

use App\Models\Crimelist;
use Livewire\Component;

class ViolentreportForm extends Component
{
    public function render()
    {
        $crimelist = Crimelist::where('category_id', 3)->get();
        return view('livewire.criminal_forms.violentreport-form', compact('crimelist'));
    }
}
