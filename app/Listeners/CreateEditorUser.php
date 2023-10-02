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
        if ($event->user instanceof User) {
            $user = User::make([
                'name' => $event->user->name,
                'email' => $event->user->email,
                'password' => $event->user->getAuthPassword(),
            ]);

            if ($event->user->isSuper()) {
                $user->role = 'editor';
            }

            $user->save();
        }
    }
}
