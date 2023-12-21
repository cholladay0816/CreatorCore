<?php

namespace App\Listeners\Commission;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SetLastCommissionAtStatistic
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
     * @param  \App\Events\Commission\Accepted  $event
     * @return void
     */
    public function handle(\App\Events\Commission\Accepted $event)
    {
        $event->commission->creator->userStatistic->fill([
            'last_commission_at' => now()->weekday(0)->setTime(0,0,0)
        ])->save();
    }
}
