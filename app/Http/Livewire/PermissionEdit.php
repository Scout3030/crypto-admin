<?php

namespace App\Http\Livewire;

use App\Models\Permission;
use Livewire\Component;

class PermissionEdit extends Component
{
    public string $name;
    public ?Permission $permission = null;

    protected function rules()
    {
        return [
            'name' => 'required|min:3|max:26|alpha_dash',
        ];
    }

    public function mount()
    {
        if ($this->permission) {
            $this->name = $this->permission->name;
        } else {
            $this->name = '';
        }
    }

    public function render()
    {
        return view('livewire.permission-edit');
    }

    public function update()
    {
        $this->validate();

        if ($this->permission->exists) {
            $this->permission->name = $this->name;
            $this->permission->save();
        } else {
            $this->permission = Permission::create(['name' => $this->name]);
        }
    }
}
