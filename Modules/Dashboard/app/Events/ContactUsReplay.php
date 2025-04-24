<?php

namespace Modules\Dashboard\app\Events;

use Illuminate\Queue\SerializesModels;

class ContactUsReplay
{
    use SerializesModels;

    public $user;

    public $message;

    /**
     * Create a new event instance.
     */
    public function __construct($user, $message)
    {
        //
        $this->user = $user;
        $this->message = $message;
    }

    /**
     * Get the channels the event should be broadcast on.
     */
    public function broadcastOn(): array
    {
        return [];
    }
}
