<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Statamic\Facades\Entry;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function getPostSuggestions(): AnonymousResourceCollection
    {
        $posts = Entry::whereInCollection(['blog'])->random(9);

        return PostResource::collection($posts);
    }

    public function updatePost(string $entryId): int
    {
        $post = Post::firstOrNew([
            'entry_id' => $entryId
        ]);

        $post->increment('reader_count');
        $post->save();

        return Response::HTTP_NO_CONTENT;
    }
}
