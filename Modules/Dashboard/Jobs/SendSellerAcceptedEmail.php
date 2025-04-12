<?php
namespace Modules\Dashboard\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Modules\Dashboard\app\Models\Admin;
use Modules\Dashboard\Mail\SellerAcceptedMail;
use Modules\Dashboard\Mail\SellerRejectMail;


class SendSellerAcceptedEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $admin;
    protected $type;
    public function __construct(Admin $admin , $type )
    {
        $this->admin = $admin;
        $this->type = $type;
    }

    public function handle()
    {
        if($this->type == 'accepted'){
            Mail::to($this->admin->email)->send(new SellerAcceptedMail($this->admin));

        }else{
            Mail::to($this->admin->email)->send(new SellerRejectMail($this->admin));

        }
    }
}
