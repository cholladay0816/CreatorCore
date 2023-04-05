<?php

namespace App\Listeners\Ticket\Submitted;

use App\Events\Ticket\Submitted;
use App\Models\Ticket;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class Email
{
    public Ticket $ticket;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\Ticket\Submitted  $event
     * @return void
     */
    public function handle(Submitted $event)
    {
        (new \App\Mail\Ticket\Submitted($this->ticket))
            ->to($this->ticket->user->email)
            ->queue();
    }
}
