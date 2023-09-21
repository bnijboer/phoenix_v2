<?php

namespace App\Listeners;

use App\Events\PostPublished;

class SendPostPublishedNotification
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
     * @param PostPublished $event
     * @return void
     */
    public function handle(PostPublished $event)
    {
        //
    }
}
