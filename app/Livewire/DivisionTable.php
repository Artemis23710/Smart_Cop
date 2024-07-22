<?php

namespace App\Livewire;

use App\Models\PoliceDivision;
use Livewire\Component;

class DivisionTable extends Component
{
    public $divisions;

    public function mount()
    {
        $this->divisions = PoliceDivision::select('id', 'district_id', 'division_name', 'status')
            ->with(['district.province' => function ($query) {
                $query->select('id', 'province_name', 'created_at', 'updated_at');
            }])
            ->get();
    }

    public function render()
    {
        return view('livewire.division-table');
    }
}
