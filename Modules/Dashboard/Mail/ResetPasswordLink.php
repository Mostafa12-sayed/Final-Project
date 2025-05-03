<?php

namespace Modules\Dashboard\Mail;

use Illuminate\Mail\Mailable;

class ResetPasswordLink extends Mailable
{
    public $admin;
    public $resetUrl;



    public function __construct($admin)
    {

        $this->admin = $admin;
        $this->resetUrl = url('/admin/change-password?token='. $admin->verification_token);

    }

    public function build()
    {
        return $this->subject('Reset Password Request')
            ->view('dashboard::emails.reset-password');
    }
}
