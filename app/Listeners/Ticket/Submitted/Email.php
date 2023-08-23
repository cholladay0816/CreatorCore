<?php

namespace App\Listeners\Ticket\Submitted;

use App\Events\Ticket\Submitted;
use App\Models\Ticket;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class Email
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\Ticket\Submitted  $event
     * @return void
     */
    public function handle(Submitted $event)
    {
        Mail::to($event->ticket->user->email)
            ->queue(new \App\Mail\Ticket\Submitted($event->ticket));
    }
}
