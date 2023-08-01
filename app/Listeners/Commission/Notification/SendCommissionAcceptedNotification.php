<?php

namespace App\Listeners\Commission\Notification;

use App\Events\Commission\Accepted;
use App\Models\Notification;

class SendCommissionAcceptedNotification
{
    /**
     * Handle the event.
     *
     * @param  Accepted $event
     * @return void
     */
    public function handle(Accepted $event)
    {
        Notification::create([
            'user_id' => $event->commission->buyer_id,
            'title' => 'Commission Accepted: ' . $event->commission->displayTitle(),
            'description' => 'Your commission to ' . $event->commission->creator->name . ' has been accepted!',
            'url' => route('commissions.show', $event->commission)
        ]);
    }
}
