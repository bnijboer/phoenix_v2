<?php

namespace App\Listeners;

use App\Events\PostCommented;
use App\Models\Comment;
use App\Models\User;

class SendPostCommentedNotification
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
     * @param PostCommented $event
     * @return void
     */
    public function handle(PostCommented $event)
    {
        if ($event->comment instanceof Comment) {
            $editorUser = User::whereRole('editor')->firstOrFail();

            if ($event->comment->user !== $editorUser) {
                dd($editorUser, $event->comment);
            }
        }
    }
}
