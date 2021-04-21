<?php

namespace App\Http\Livewire;

use App\Helpers\Facades\Permissions;
use App\Helpers\Services\SegmentService;
use App\Models\Permission;
use Auth;
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
        if (auth()->user()->cannot('role-edit')) {
            abort(403);
        }
        $this->validate();

        if (optional($this->permission)->exists) {
            $this->permission->name = $this->name;
            $this->permission->save();
        } else {
            $this->permission = Permission::create(['name' => $this->name]);
        }

        return redirect()->route('permissions.index');
    }
}
