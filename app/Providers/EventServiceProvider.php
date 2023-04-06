<?php

namespace App\Providers;

use App\Events\Commission\Accepted;
use App\Events\Commission\Archived;
use App\Events\Commission\Completed;
use App\Events\Commission\Created;
use App\Listeners\SendCommissionAcceptedNotification;
use App\Listeners\SendCommissionArchivedNotification;
use App\Listeners\SendCommissionCompletedNotification;
use App\Listeners\SendCommissionCreatedNotification;
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
            SendCommissionCreatedNotification::class,
        ],
        Completed::class => [
            SendCommissionCompletedNotification::class,
        ],
        Archived::class => [
            SendCommissionArchivedNotification::class,
        ],
        Accepted::class => [
            SendCommissionAcceptedNotification::class,
        ],

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
