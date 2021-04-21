<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class GetFirstName extends Component
{
    public $first_name = "Merchant";

    protected $listeners = ['setFirstName' => 'changeFirstName'];

    public function changeFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    public function mount()
    {
        $this->first_name = Auth::user()->first_name ? Auth::user()->first_name : 'Merchant';
    }

    public function render()
    {
        return view('livewire.get-first-name');
    }
}
