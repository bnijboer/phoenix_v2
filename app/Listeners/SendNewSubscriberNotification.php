<?php

namespace App\Listeners;

use App\Events\NewSubscriber;
use App\Mail\NewSubscriberMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SendNewSubscriberNotification
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
     * @param NewSubscriber $event
     * @return void
     */
    public function handle(NewSubscriber $event): void
    {
        $editorUser = User::whereRole('editor')->firstOrFail();

        if ($event->email !== $editorUser) {
            Mail::to($editorUser->email)->send(
                new NewSubscriberMail($event->email)
            );
        }
    }
}
