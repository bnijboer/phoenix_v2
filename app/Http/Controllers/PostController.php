<?php

namespace App\Http\Controllers;

use App\Exceptions\StatamicEntryNotFoundException;
use App\Http\Resources\PostPreviewResource;
use App\Http\Resources\PostResource;
use App\Services\PostService;
use App\Services\SubscriptionService;
use App\Traits\RetrievesFilterOptions;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    use RetrievesFilterOptions;

    public function __construct(
        private PostService $postService,
        private SubscriptionService $subscriptionService
    ) {}

    public function indexPage(Request $request): \Inertia\Response
    {
        $results = $this->postService->getPaginatedPosts($this->getFilterOptions($request));

        return inertia('posts/index-page', [
            'data' => PostPreviewResource::collection($results->all()),
            'meta' => [
                'page' => $results->currentPage(),
                'total' => $results->total(),
                'viewIndex' => $request->hasHeader('viewIndex') ? (int) $request->header('viewIndex') : null
            ]
        ]);
    }

    /**
     * @throws StatamicEntryNotFoundException
     */
    public function showPage(Request $request, string $entryId): \Inertia\Response
    {
        $referer = $request->headers->get('referer');

        $originUrl = parse_url(config('app.url'), PHP_URL_HOST) === parse_url($referer, PHP_URL_HOST)
            ? $referer
            : '';

        return inertia('posts/show-page', [
            'data'  => new PostResource($this->postService->getPost($entryId)),
            'meta' => [
                'originUrl' => $originUrl,
                'viewIndex' => $request->hasHeader('viewIndex') ? (int)$request->header('viewIndex') : null,
            ]
        ]);
    }

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
