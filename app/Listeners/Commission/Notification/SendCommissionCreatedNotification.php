<?php

namespace App\Listeners\Commission\Notification;

use App\Events\Commission\Created;
use App\Models\Notification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class SendCommissionCreatedNotification
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
            'user_id' => $event->commission->creator_id,
            'title' => 'Commission Created: ' . $event->commission->displayTitle(),
            'description' => 'You have received a new commission from ' . $event->commission->buyer->name,
            'url' => route('commissions.show', $event->commission)
        ]);
    }
}
