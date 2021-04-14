<?php

namespace App\Http\Controllers\Users;

use App\Helpers\Roles;
use App\Http\Requests\Users\CreateMerchant;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UsersListController
{
    public function __invoke(Request $request)
    {
        if ($request->user()->cannot('users.view')) {
            abort(403);
        }

        $users = User::whereRoles(Roles::MERCHANT)->paginate($request->perPage ?? 10);

        return view('user.list', compact('users'));
    }

    public function editMerchant(?User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function deleteMerchant(User $user): array
    {
        try {
            $user->delete();
        } catch (Exception $e) {
        }

        return [];
    }

    public function storeMerchant(CreateMerchant $request): RedirectResponse
    {
        User::create($request->all());

        return redirect()->route('users.list');
    }
}
