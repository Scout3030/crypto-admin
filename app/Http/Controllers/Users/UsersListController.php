<?php

namespace App\Http\Controllers\Users;

use App\DataTables\UsersDataTable;
use App\DataTables\UsersMerchantDataTable;
use App\Dto\NewAdminCreatedEmail;
use App\Helpers\Enums\YesNo;
use App\Helpers\Services\SegmentService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateAdmin;
use App\Mail\AccountActivatedMail;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Throwable;
use Yajra\DataTables\DataTables;

class UsersListController extends Controller
{

    public function index(Request $request, UsersDataTable $dataTable)
    {
        if ($request->user()->cannot('role-list')) {
            abort(403);
        }

        return $dataTable->render('user.index');
    }

    public function editAdmin($id = 0)
    {
        return view('user.edit', compact('id'));
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
            'role_id'    => $request->role_id,
        ]);

        $user->password = bcrypt($request->password);
        $user->save();

        $obj = new NewAdminCreatedEmail($user->email, $request->password);
        $this->sendMailToNewUser($obj);

        return redirect()->route('users.list');
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
            'role_id'    => $input['role_id'],
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

    public function merchantList(Request $request, UsersMerchantDataTable $dataTable)
    {
        if ($request->user()->cannot('merchant-management')) {
            abort(403);
        }

        return $dataTable->render('user.merchant-list');
    }

    public function editMerchant()
    {

    }

    public function deleteMerchant(Request $request)
    {
        try {
            User::findOrFail($request->id)->delete();
        } catch (Throwable $exception) {
        }

        return [];
    }

    public function delete(Request $request)
    {
        try {
            User::findOrFail($request->id)->delete();
        } catch (Throwable $exception) {
        }

        return [];
    }

    public function datatable(Request $request){
        if ($request->ajax()) {
            $actions = 'user.action';
            $users = DB::table('users')
                ->whereIn('role', [Roles::ROOT, Roles::MANAGER])
                ->select(['id', 'first_name', 'last_name', 'email', 'is_active', 'created_at', 'updated_at']);
            return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('actions', $actions)
                ->filter(function ($query) use ($request) {
                    if ($request->has('otp_required') && $request->otp_required != null) {
                        $query->whereOtpRequired((int) $request->get('otp_required'));
                    }
                    if ($request->has('blocked') && $request->blocked != null) {
                        if($request->blocked == YesNo::YES){
                            $query->whereNotNull('blocked_at');
                        }else{
                            $query->whereNull('blocked_at');
                        }
                    }
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
    }
}
