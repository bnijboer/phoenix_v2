<?php

namespace App\Listeners;

use App\Events\PostCommented;
use App\Mail\NewPostCommentMail;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

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
                Mail::to($editorUser->email)->send(
                    new NewPostCommentMail(
                        'test',
                        $event->comment->user->name,
                        route('posts.show', $event->comment->entry_id)
                    )
                );
            }
        }
    }
}
