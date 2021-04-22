<?php

namespace App\Http\Livewire;

use App\Helpers\Enums\YesNo;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RoleCreate extends Component
{
    public $title, $action, $role, $permissions;
    public $role_id, $name, $permissions_selected = [];

    protected $listeners = [
        'setPermission' => 'setPermission',
    ];

    public function setPermission($item)
    {
        if ( in_array( (int) $item, $this->permissions_selected) ) {

            unset($this->permissions_selected[$item]);

        } else {
            array_push($this->permissions_selected, (int) $item);
        }

    }

    protected function rules()
    {
        return [
            'name' => 'required|min:3|max:26',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.role-create');
    }

    public function mount($id)
    {
        if ( $id != 0 ) {
            $role = Role::find($id);

            $this->role = $role;
            $this->title = 'Edit';
            $this->role_id = $role->id;
            $this->name = $role->name;
            $this->permissions_selected = DB::table('permission_role')->where('permission_role.role_id', $role->id)->pluck('permission_role.permission_id', 'permission_role.permission_id')->all();
        } else {
            $this->title = 'Create';
            $this->role_id  = 0;
        }

        $this->permissions = Permission::all();
    }

    public function store()
    {
        if (request()->user()->cannot('role-edit')) {
            abort(403);
        }

        if ($this->role_id > 0) {
            return $this->updateRole();
        }

        $role = Role::create([
            'name'     => $this->name,
            'is_admin' => YesNo::YES,
        ]);

        $role->permissions()->attach($this->permissions_selected);

        session()->flash('success', 'Registration created successfully!');

        return redirect()->route('roles.list');
    }

    private function updateRole()
    {
        $role = tap(Role::findOrFail($this->role_id), function ($role) {
            $role->update([
                'name' => $this->name
            ]);
        });

        $role->permissions()->sync($this->permissions_selected);

        session()->flash('success', 'Registration updated successfully!');

        return redirect()->route('roles.list');
    }
}
