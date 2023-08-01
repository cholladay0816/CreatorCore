<?php

namespace App\Providers;

use App\Events\Commission\Accepted;
use App\Events\Commission\Archived;
use App\Events\Commission\Completed;
use App\Events\Commission\Created;
use App\Listeners\Commission\Notification\SendCommissionAcceptedNotification;
use App\Listeners\Commission\Notification\SendCommissionArchivedNotification;
use App\Listeners\Commission\Notification\SendCommissionCompletedNotification;
use App\Listeners\Commission\Notification\SendCommissionCreatedNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        Created::class => [
            // @todo: add normal logic
            // @todo: move email here
            SendCommissionCreatedNotification::class,
        ],
        Completed::class => [
            // @todo: add normal logic
            // @todo: move email here
            SendCommissionCompletedNotification::class,
        ],
        Archived::class => [
            // @todo: add normal logic
            // @todo: move email here
            SendCommissionArchivedNotification::class,
        ],
        Accepted::class => [
            // @todo: add normal logic
            // @todo: move email here
            SendCommissionAcceptedNotification::class,
        ],

        /* @todo:
         *
         * Disputed
         * Refunded
         * Pending
         * Failed Transaction
         * Rejected order
         * Overdue
         */

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
