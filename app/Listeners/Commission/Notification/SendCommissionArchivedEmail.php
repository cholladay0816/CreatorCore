<?php

namespace App\Listeners\Commission\Notification;

use App\Events\Commission\Archived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendCommissionArchivedEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Archived  $event
     * @return void
     */
    public function handle(Archived $event)
    {
        $commission = $event->commission;
        Mail::to($commission->creator->email)->queue(new \App\Mail\Commission\Archived($commission));
    }
}
