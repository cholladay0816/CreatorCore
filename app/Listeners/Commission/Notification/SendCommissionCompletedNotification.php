<?php

namespace App\Listeners\Commission\Notification;

use App\Events\Commission\Created;
use App\Models\Notification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class SendCommissionCompletedNotification
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
            'title' => 'Commission Complete: ' . $event->commission->displayTitle(),
            'description' => 'Your commission to ' . $event->commission->creator->name . ' has been completed!
            You have ' . config('commission.days_to_archive') . 'days to review and accept the final product.',
            'url' => route('commissions.show', $event->commission)
        ]);
    }
}
