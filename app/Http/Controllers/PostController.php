<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostPreviewResource;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Statamic\Facades\Entry;

class PostController extends Controller
{
    public function index(Request $request): Response
    {
        $page = (int) ($request->query('page') ?? 1);
        $limit = $request->query('limit') ?? 5;
        $total = Entry::whereCollection('blog')->count();

        $posts = Entry::query()
            ->where('collection', 'blog')
            ->forPage($page, $limit)
            ->orderBy('date', 'desc')
            ->get();

        return Inertia::render('posts/index-page', [
            'posts' => PostPreviewResource::collection($posts),
            'meta' => [
                'page' => $page,
                'total' => $total,
                'viewIndex' => $request->headers->get('viewIndex') ? (int) $request->headers->get('viewIndex') : null
            ]
        ]);
    }

    public function show(Request $request, string $id): Response
    {
        $entry = Entry::find($id);

        return Inertia::render('posts/show-page', [
            'id' => $entry->id,
            'title' => $entry->title,
            'body' => $entry->body,
            'headerImageUrl' => $entry->header_image?->url,
            'originUrl' => $request->headers->get('originUrl') ?? route('posts.index'),
            'viewIndex' => $request->headers->get('viewIndex') ? (int) $request->headers->get('viewIndex') : null
        ]);
    }
}
