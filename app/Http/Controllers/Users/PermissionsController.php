<?php

namespace App\Http\Controllers\Users;

use App\DataTables\PermissionsDataTable;
use App\Helpers\Services\SegmentService;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Throwable;

class PermissionsController extends Controller
{
    public function index(Request $request, PermissionsDataTable $dataTable)
    {
        if ($request->user()->cannot('role-list')) {
            abort(403);
        }

        return $dataTable->render('permissions.index');
    }

    public function edit(Request $request, Permission $permission)
    {
        if ($request->user()->cannot('role-edit')) {
            abort(403);
        }

        if (!optional($permission)->exists) {
            $permission = null;
        }

        return view('permissions.edit', compact('permission'));
    }

    public function delete(Request $request, SegmentService $segment)
    {
        try {
            $permission = tap(Permission::findOrFail($request->id), static function ($permission) {
                $permission->delete();
            });

            $segment->event('Permission deleted', ['permission' => $permission->toArray()]);
        } catch (Throwable $exception) {
        }

        return [];
    }
}
