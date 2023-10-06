<?php

namespace App\Providers;

use App\Events\PostCommented;
use App\Events\NewSubscriber;
use App\Listeners\SendPostCommentedNotification;
use App\Listeners\SendPostPublishedNotification;
use App\Listeners\CreateEditorUser;
use App\Listeners\SendNewSubscriberNotification;
use App\Listeners\SetLastLoginTimestamp;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Statamic\Events\EntryCreated;
use Statamic\Events\UserCreated;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Login::class => [
            SetLastLoginTimestamp::class,
        ],
        UserCreated::class => [
            CreateEditorUser::class,
        ],
        NewSubscriber::class => [
            SendNewSubscriberNotification::class,
        ],
        EntryCreated::class => [
            SendPostPublishedNotification::class,
        ],
        PostCommented::class => [
            SendPostCommentedNotification::class,
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
