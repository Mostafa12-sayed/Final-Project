<?php

namespace Modules\Dashboard\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Dashboard\app\Models\Admin;

class SellerRejectMail extends Mailable
{
    use Queueable, SerializesModels;

    public $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function build()
    {
        return $this->subject('Your Store Has Been rejected')
            ->view('dashboard::emails.reject-email');
    }
}
