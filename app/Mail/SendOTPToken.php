<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendOTPToken extends Mailable
{
    use Queueable, SerializesModels;

    private $otpToken;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($otpToken)
    {
        $this->otpToken = $otpToken;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(__("One Time Password Verification"))
                    ->view('emails.send_otp_token')
                    ->with(['otp_token' => $this->otpToken]);
    }
}
