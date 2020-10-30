<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\TaskCreatedEvent' => [
            'App\Listeners\TaskCreatedListener',
        ],
        'App\Events\TaskUpdatedEvent' => [
            'App\Listeners\TaskUpdatedListener',
        ],
        'App\Events\TaskDeletedEvent' => [
            'App\Listeners\TaskDeletedListener',
        ],
        'App\Events\TaskCompletedEvent' => [
            'App\Listeners\TaskCompletedListener',
        ],
    ];

    public function boot()
    {
        //
    }
}
