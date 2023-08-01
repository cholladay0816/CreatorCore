<?php

namespace App\Listeners\Commission\Notification;

use App\Events\Commission\Created;
use App\Models\Notification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class SendCommissionArchivedNotification
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
            'title' => 'Commission Archived: ' . $event->commission->displayTitle(),
            'description' => 'Your commission to ' . $event->commission->buyer->name . ' has been completed!',
            'url' => route('commissions.show', $event->commission)
        ]);
    }
}
