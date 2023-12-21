<?php

namespace App\Listeners\Review;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateUserRatingStatistic
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
    public function handle($event)
    {
        /** @var User $creator */
        $creator = $event->review->commission->creator;
        $creator->userStatistic->fill([
            'rating' => $creator->rating()
        ])->save();
    }
}
