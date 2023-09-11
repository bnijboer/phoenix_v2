<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostPreviewResource;
use App\Http\Resources\PostResource;
use App\Services\PostService;
use App\Traits\RetrievesFilterOptions;
use Illuminate\Http\Request;
use Inertia\Response;

class PageController extends Controller
{
    use RetrievesFilterOptions;

    public function __construct(
        private PostService $postService
    ) {}

    public function indexPage(Request $request): Response
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

    public function showPage(Request $request, string $entryId): Response
    {
        return inertia('posts/show-page', [
            'data'  => new PostResource($this->postService->getPost($entryId)),
            'meta' => [
                'originUrl' => $request->header('originUrl', route('pages.index')),
                'viewIndex' => $request->hasHeader('viewIndex') ? (int)$request->header('viewIndex') : null,
            ]
        ]);
    }

    public function loginPage(): Response
    {
        return inertia('security/login-page');
    }

    public function registerPage(): Response
    {
        return inertia('security/register-page');
    }
}
