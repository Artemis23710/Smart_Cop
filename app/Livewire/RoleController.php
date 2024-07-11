<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleController extends Component
{
    public $name;

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function insert()
    {
        $this->validate();

        Role::create([
            'name' => $this->name
        ]);

        session()->flash('message', 'Role successfully created.');

        $this->reset();
    }

    // public function render()
    // {
    //     return view('livewire.role-controller');
    // }
}
