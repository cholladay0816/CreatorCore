<?php

namespace App\Listeners\Commission\Notification;

use App\Events\Commission\Completed;
use App\Models\Notification;

class SendCommissionCompletedNotification
{
    /**
     * Handle the event.
     *
     * @param  Completed $event
     * @return void
     */
    public function handle(Completed $event)
    {
        Notification::create([
            'user_id' => $event->commission->buyer_id,
            'title' => 'Commission Complete: ' . $event->commission->displayTitle(),
            'description' => 'Your commission to ' . $event->commission->creator->name . ' has been completed!
            You have ' . config('commission.days_to_archive') . 'days to review and accept the final product.',
            'url' => route('commissions.show', $event->commission)
        ]);
    }
}
