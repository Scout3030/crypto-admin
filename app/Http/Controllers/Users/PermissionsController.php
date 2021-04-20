<?php

namespace App\Http\Controllers\Users;

use App\DataTables\PermissionsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    public function index(PermissionsDataTable $dataTable)
    {
        return $dataTable->render('permissions.index');
    }

    public function edit(Request $request, ?Permission $permission)
    {
        if (!$permission->exists) {
            $permission = null;
        }
        return view('permissions.edit', compact('permission'));
    }

    public function store(Request $request)
    {

    }
}
