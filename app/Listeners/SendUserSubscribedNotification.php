<?php

namespace App\Listeners;

use App\Events\UserSubscribed;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendUserSubscribedNotification
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
     * @param  \App\Events\UserSubscribed  $event
     * @return void
     */
    public function handle(UserSubscribed $event)
    {
        if ($event->user instanceof User) {
            $editorUser = User::whereRole('editor')->firstOrFail();

            if ($event->user !== $editorUser) {
                dd($event->user);
            }
        }
    }
}
