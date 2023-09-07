<?php

namespace App\Http\Controllers;

use App\Exceptions\StatamicEntryNotFoundException;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Statamic\Facades\Entry;

class CommentController extends Controller
{
    /**
     * @throws StatamicEntryNotFoundException
     */
    public function store(CommentRequest $commentRequest): CommentResource
    {
        if (Entry::find($commentRequest->get('entryId')) === null) {
            throw new StatamicEntryNotFoundException();
        }

        $post = Post::firstOrCreate([
            'entry_id' => $commentRequest->get('entryId')
        ]);

        $comment = Auth::user()->comments()->create([
            'body' => $commentRequest->get('body'),
            'entry_id' => $post->entry_id,
        ]);

        return new CommentResource($comment);
    }
}
