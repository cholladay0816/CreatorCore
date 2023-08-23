<?php

namespace App\Listeners\CommissionMessage;

use App\Events\CommissionMessage\Send;
use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ReceivedNotification
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
     * @param  object  $event
     * @return void
     */
    public function handle(Send $event)
    {
        $title = $event->commissionMessage->user->name . ' has sent a new message! (Order #' . $event->commissionMessage->commission_id .')';
        $commission = $event->commissionMessage->commission;
        $recipient = $commission->buyer_id == $event->commissionMessage->user_id
            ? $commission->creator
            : $commission->buyer;
        // Get last notification not read
        $lastNotification = $recipient->getLastUnreadNotification();
        // If it's the same thing, don't send another
        if($lastNotification?->title == $title)
        {
            return;
        }

        Notification::create([
            'user_id' => $recipient->id,
            'title' => $title,
            'url' => route('commissions.show', $commission)
        ]);
    }
}
