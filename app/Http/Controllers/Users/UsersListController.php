<?php

namespace App\Http\Controllers\Users;

use App\Dto\NewAdminCreatedEmail;
use App\Helpers\Enums\YesNo;
use App\Helpers\Roles;
use App\Http\Requests\Users\CreateAdmin;
use App\Mail\AccountActivatedMail;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Throwable;

class UsersListController
{
    public function __invoke(Request $request)
    {
        if ($request->user()->cannot('users.view')) {
            abort(403);
        }

        $users = User::query()->whereHas('roles', function ($query) {
            $query->whereIsAdmin(YesNo::YES);
        });

        if ($request->search) {
            $search = $request->search;
            $users = $users->where(function ($query) use ($search) {
                $query->where('first_name', 'LIKE', "%{$search}%")
                      ->orWhere('last_name', 'LIKE', "%{$search}%")
                      ->orWhere('email', 'LIKE', "%{$search}%");
            });

        }

        $users = $users->paginate($request->perPage ?? 10);

        return view('user.list', compact('users'));
    }

    public function editAdmin(User $user)
    {
        $user = $user->exists ? $user : null;
        $roles = Role::whereIsAdmin(YesNo::YES)->get(['id', 'name']);

        return view('user.edit', compact('user', 'roles'));
    }

    public function deleteAdmin(User $user): array
    {
        try {
            $user->delete();
        } catch (Exception $e) {
        }

        return [];
    }

    public function storeAdmin(CreateAdmin $request): RedirectResponse
    {
        $isActiveStatus = $this->getActiveStatus($request->is_active);
        $inputData = $request->all();
        $inputData['is_active'] = $isActiveStatus;

        if ($request->id) {
            return $this->updateUser($inputData);
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'is_active'  => $inputData['is_active'],
        ]);

        $user->password = bcrypt($request->password);
        $user->save();

        $obj = new NewAdminCreatedEmail($user->email, $request->password);
        $this->sendMailToNewUser($obj);

        return redirect()->route('users.list')->withInput();
    }

    private function updateUser(array $input)
    {
        try {
            $user = User::findOrFail($input['id']);
        } catch (ModelNotFoundException $exception) {
            return back(404);
        }


        $user->forceFill([
            'first_name' => $input['first_name'],
            'last_name'  => $input['last_name'],
            'email'      => $input['email'],
            'is_active'  => $input['is_active'],
        ]);

        if ($input['password']) {
            $user->password = bcrypt($input['password']);
        }

        if ($user->isDirty()) {
            $user->save();
        }

        return redirect()->route('users.list');
    }

    private function sendMailToNewUser(NewAdminCreatedEmail $obj): void
    {
        $message = (new AccountActivatedMail($obj))
            ->onQueue('emails');

        Mail::to($obj->email)->queue($message);
    }

    public function changeOtpStatus(Request $request)
    {
        $status = $request->status === 'true' ? YesNo::YES : YesNo::NO;

        try {
            User::whereId($request->id)->update([
                'otp_required' => $status,
            ]);
        } catch (Throwable $exception) {
            abort(400);
        }

        return [];
    }

    private function getActiveStatus($is_active): int
    {
        return $is_active === 'active' ? YesNo::YES : YesNo::NO;
    }
}
