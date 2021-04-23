<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SearchRoleFilter extends Component
{
    public string $permission = '';

    public function search(){
        $this->emit('filterPermission', $this->permission);
    }

    public function render()
    {
        return view('livewire.search-role-filter');
    }
}
