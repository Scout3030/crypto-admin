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

        $segment = app(SegmentService::class)->init(Auth::user());

        if (optional($this->permission)->exists) {
            $this->permission->name = $this->name;
            $this->permission->save();
            $segment->event('Permission updated', ['permission' => $this->permission->toArray()]);
        } else {
            $this->permission = Permission::create(['name' => $this->name]);
            $segment->event('Permission created', ['permission' => $this->permission->toArray()]);
        }

        return redirect()->route('permissions.index');
    }
}
