<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Rules\CurrentPassword;
use App\Rules\StrengthPassword;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use PHPUnit\Exception;
use Segment;

class NewPasswordForm extends Component
{
    public $current_password;
    public $password;
    public $password_confirmation;

    protected function rules()
    {
        return [
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', new StrengthPassword()]
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.new-password-form');
    }

    public function update()
    {
        $this->validate();

        $this->validate([
            'current_password' => [new CurrentPassword()],
        ]);

        /** @var User */
        $user = auth()->user();
        $user->password = bcrypt($this->password);
        $user->save();

        Segment::track(array(
            "userId" => $user->id,
            "event" => "User change password"
        ));

//        try{
//            Mail::to($user->email)->send(new NewPasswordMail());
//            Segment::track(array(
//                "userId" => $user->id,
//                "event" => "Send email: new password confirmation"
//            ));
//        }catch (Exception $e){
//            Segment::track(array(
//                "userId" => $user->id,
//                "event" => "Send email failed: new password confirmation",
//                "properties" => array(
//                    "error" => $e->getMessage()
//                )
//            ));
//        }

        session()->flash('success', true);

        $this->current_password = '';
        $this->password = '';
        $this->password_confirmation = '';
    }
}
