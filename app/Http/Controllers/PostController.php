<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
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
        $this->postService->updatePostReaderCount($entryId);

        return Response::HTTP_NO_CONTENT;
    }
}
