<?php

namespace App\Listeners;

use App\Models\User;
use Statamic\Events\UserCreated;

class CreateEditorUser
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
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event): void
    {
        User::create([
            'name' => $event->user->name,
            'email' => $event->user->email,
            'role' => $event->user->isSuper() ? 'editor' : null,
            'password' => $event->user->getAuthPassword(),
        ]);
    }
}
