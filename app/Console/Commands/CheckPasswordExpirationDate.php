<?php

namespace App\Console\Commands;

use App\Mail\PasswordExpiredMail;
use App\Models\User;
use Illuminate\Console\Command;
use Mail;

class CheckPasswordExpirationDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:check-password';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check users expiration password date';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        User::whereDate('exp_date', now()->addDays(3))
            ->get()
            ->each(function ($user) {
                $message = (new PasswordExpiredMail($user))
                    ->onQueue('emails');

                Mail::to($user->email)->queue($message);
            });

        return 0;
    }
}
