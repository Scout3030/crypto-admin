<?php

namespace App\Http\Controllers\Users;

use App\Helpers\Enums\YesNo;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Throwable;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->cannot('role-list')) {
            abort(403);
        }

        $roles = Role::query();

        if ($request->search) {
            $search = $request->search;
            $roles = $roles->where('name', 'LIKE', "%{$search}");

        }
        $roles = $roles->whereIsAdmin(YesNo::YES)->get();

        return view('roles.list', compact('roles'));
    }

    public function store(Request $request)
    {
        if ($request->user()->cannot('role-edit')) {
            abort(403);
        }
        if ($request->id) {
            return $this->updateRole($request->all());
        }

        $role = Role::create([
            'name'     => $request->name,
            'is_admin' => YesNo::YES,
        ]);

        $role->permissions()->attach($request->permissions);

        return redirect()->route('roles.list');
    }


    public function edit(Request $request, ?Role $role)
    {
        if ($request->user()->cannot('role-edit')) {
            abort(403);
        }

        $permissions = Permission::all();

        return view('roles.edit', compact('role', 'permissions'));
    }

    public function show(Request $request, Role $role)
    {
        if ($request->user()->cannot('role-list')) {
            abort(403);
        }

        return view('roles.view', compact('role'));
    }

    public function delete(Request $request, Role $role)
    {
        if ($request->user()->cannot('role-delete')) {
            abort(403);
        }

        try {
            $role->delete();
        } catch (Throwable $exception) {
        }

        return [];
    }

    private function updateRole(array $inputData)
    {
        $role = tap(Role::findOrFail($inputData['id']), function ($role) use ($inputData) {
            $role->update([
                'name' => $inputData['name'],
            ]);
        });

        $role->permissions()->sync($inputData['permissions']);

        return redirect()->route('roles.list');
    }
}
