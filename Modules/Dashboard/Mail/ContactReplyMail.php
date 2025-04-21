<?php
namespace Modules\Dashboard\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Dashboard\app\Models\Admin;


class ContactReplyMail extends Mailable
{
    public $user;
    public $reply;
    public function __construct($user, $reply)
    {
        $this->reply = $reply;
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('رد على رسالتك')
            ->view('dashboard::emails.contact_reply');
    }
}
