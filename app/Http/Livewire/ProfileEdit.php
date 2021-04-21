<?php

namespace App\Http\Livewire;

use App\Helpers\Enums\Formats;
use App\Mail\NotificationChangeEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ProfileEdit extends Component
{
    public $user;
    public $first_name, $last_name, $email, $timezone, $date_format, $user_id;

    protected function rules()
    {
        return [
            'first_name' => 'required|min:3|max:26',
            'last_name' => 'required|min:3|max:26',
            'email' => 'required|email|unique:users,email,' . $this->user_id,
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->user = Auth::user();

        $this->user_id = $this->user->id;
        $this->first_name = $this->user->first_name;
        $this->last_name = $this->user->last_name;
        $this->email = $this->user->email;
        $this->timezone = $this->user->timezone;
        $this->date_format = $this->user->date_format;

    }

    public function render()
    {
        $dates = Formats::DATE;
        $timezones = Formats::TIMEZONES;

        return view('livewire.profile-edit', compact('dates', 'timezones'));
    }

    public function update()
    {
        $this->validate();

        $email_old = $this->user->email;

        $this->user->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'timezone' => $this->timezone,
            'date_format' => $this->date_format,
        ]);

        //$this->emit('setFirstName', $this->first_name);

        Session::put('user_timezone', $this->timezone);
        Session::put('user_date_format', $this->date_format);

        if ( $email_old != $this->email ) {

            try {
                Mail::to($email_old)->send(new NotificationChangeEmail());
            } catch (\Throwable $e) {
                report($e);
                return back()->withErrors('An error occurred while sending the verification email.');
            }

        }

        session()->flash('success', 'Registration created successfully!');
        
        return back()->with('success', 'Hola');
    }
}
