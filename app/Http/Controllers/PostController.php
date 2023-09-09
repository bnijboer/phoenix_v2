<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function __construct(
        private PostService $postService
    ) {}

    public function getPostSuggestions(): AnonymousResourceCollection
    {
        return PostResource::collection(
            $this->postService->getRandomizedPostCollection()
        );
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
