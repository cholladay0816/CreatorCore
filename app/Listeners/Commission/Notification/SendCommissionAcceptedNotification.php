<?php

namespace App\Listeners\Commission\Notification;

use App\Events\Commission\Created;
use App\Models\Notification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class SendCommissionAcceptedNotification
{
    /**
     * Handle the event.
     *
     * @param  Created $event
     * @return void
     */
    public function handle(Created $event)
    {
        Notification::create([
            'user_id' => $event->commission->buyer_id,
            'title' => 'Commission Accepted: ' . $event->commission->displayTitle(),
            'description' => 'Your commission to ' . $event->commission->creator->name . ' has been accepted!',
            'url' => route('commissions.show', $event->commission)
        ]);
    }
}
