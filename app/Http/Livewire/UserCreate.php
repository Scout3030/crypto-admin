<?php

namespace App\Http\Livewire;

use App\Dto\NewAdminCreatedEmail;
use Livewire\Component;

use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

use App\Helpers\Enums\YesNo;
use App\Mail\AccountActivatedMail;
use App\Rules\StrengthPassword;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Mail;

class UserCreate extends Component
{
    public $title, $action, $roles;
    public $user_id, $first_name, $last_name, $email, $password, $password_confirmation, $role_id = "", $is_active;

    protected $listeners = [
        'setRole' => 'setRole',
        'setStatus' => 'setStatus'
    ];

    public function setRole($role)
    {
        $this->role_id = $role;
    }

    public function setStatus($status)
    {
        $this->is_active = $status;
    }

    protected function rules()
    {
        return [
            'first_name' => 'required|min:3|max:26',
            'last_name' => 'required|min:3|max:26',
            'email' => 'required|email|unique:users,email,' . $this->user_id,
            'role_id' => 'required|min:1'
            /*'password' => [
                Rule::requiredIf( Str::length($this->password) > 0 | Str::length($this->password_confirmation) > 0 ),
                'confirmed',
                new StrengthPassword
            ]*/
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount($id)
    {
        if ( $id != 0 ) {
            $user = User::find($id);

            $this->title = 'Edit';
            $this->action = 'update';
            $this->user_id = $user->id;
            $this->first_name = $user->first_name;
            $this->last_name = $user->last_name;
            $this->email = $user->email;
            $this->role_id = $user->role_id;
            $this->is_active = $user->is_active;
        } else {
            $this->title = 'Create';
            $this->action = 'store';
            $this->user_id  = 0;
        }

        $this->roles = Role::whereIsAdmin(YesNo::YES)->get(['id', 'name']);
    }

    public function render()
    {
        return view('livewire.user-create');
    }

    public function store()
    {
        $this->validate();

        if ( Str::length($this->password) > 0 || Str::length($this->password_confirmation) > 0 ) {
            $this->validate([
                'password' => ['required', 'confirmed', new StrengthPassword]
            ]);
        }

        $user = User::create([
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'email'      => $this->email,
            'is_active'  => $this->getActiveStatus($this->is_active),
            'role_id'    => $this->role_id,
        ]);

        $user->password = bcrypt($this->password);
        $user->save();

        $obj = new NewAdminCreatedEmail($user->email, $this->password);
        $this->sendMailToNewUser($obj);

        session()->flash('success', 'Registration created successfully!');

        return redirect()->route('users.list');

    }

    public function update()
    {
        $this->validate();

        try {
            $user = User::findOrFail($this->user_id);
        } catch (ModelNotFoundException $exception) {
            return back(404);
        }

        $user->forceFill([
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'email'      => $this->email,
            'is_active'  => $this->getActiveStatus($this->is_active),
            'role_id'    => $this->role_id,
        ]);

        if ( Str::length($this->password) > 0 || Str::length($this->password_confirmation) > 0 ) {

            $this->validate([
                'password' => ['required', 'confirmed', new StrengthPassword]
            ]);

            $user->password = bcrypt($this->password);
        }

        if ($user->isDirty()) {
            $user->save();
        }

        session()->flash('success', 'Registration updated successfully!');

        return redirect()->route('users.list');
    }

    private function getActiveStatus($is_active): int
    {
        return $is_active === 'active' ? YesNo::YES : YesNo::NO;
    }

    private function sendMailToNewUser(NewAdminCreatedEmail $obj): void
    {
        $message = (new AccountActivatedMail($obj))
            ->onQueue('emails');

        Mail::to($obj->email)->queue($message);
    }
}