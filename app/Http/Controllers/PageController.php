<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostPreviewResource;
use App\Http\Resources\PostResource;
use App\Services\PostService;
use Illuminate\Http\Request;
use Inertia\Response;
use Statamic\Facades\Entry;

class PageController extends Controller
{
    public function __construct(
        private PostService $postService
    ) {}

    public function loginPage(): Response
    {
        return inertia('security/login-page');
    }

    public function registerPage(): Response
    {
        return inertia('security/register-page');
    }

    public function indexPage(Request $request): Response
    {
        if ($request->query('query')) {
            dd($request->query('query'));
        }

        if ($request->query('tag')) {
            dd($request->query('tag'));
        }


        $page  = (int) $request->query('page', 1);
        $limit = (int) $request->query('limit', 10);
        $total = Entry::whereCollection('blog')->count();

        $orderBy        = $request->query('orderBy', 'date');
        $orderDirection = $request->query('orderDirection', 'desc');

        $posts = Entry::query()
            ->where('collection', 'blog')
            ->forPage($page, $limit)
            ->orderBy($orderBy, $orderDirection)
            ->get();

        return inertia('posts/index-page', [
            'data' => PostPreviewResource::collection($posts),
            'meta' => [
                'page' => $page,
                'total' => $total,
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
}
