<?php

namespace App\Listeners\Commission\Notification;

use App\Events\Commission\Archived;
use App\Models\Notification;

class SendCommissionArchivedNotification
{
    /**
     * Handle the event.
     *
     * @param  Archived $event
     * @return void
     */
    public function handle(Archived $event)
    {
        Notification::create([
            'user_id' => $event->commission->creator_id,
            'title' => 'Commission Archived: ' . $event->commission->displayTitle(),
            'description' => 'Your commission to ' . $event->commission->buyer->name . ' has been completed!',
            'url' => route('commissions.show', $event->commission)
        ]);
    }
}
