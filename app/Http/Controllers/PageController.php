<?php

namespace App\Http\Controllers;

use App\Exceptions\StatamicEntryNotFoundException;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PostPreviewResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Inertia\Response;
use Statamic\Facades\Entry;

class PageController extends Controller
{
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
        $page  = ((int) $request->query('page')) ?? 1;
        $limit = $request->query('limit') ?? 10;
        $total = Entry::whereCollection('blog')->count();

        $orderBy        = $request->query('orderBy') ?? 'date';
        $orderDirection = $request->query('orderDirection') ?? 'desc';

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
                'viewIndex' => $request->headers->get('viewIndex') ? (int) $request->headers->get('viewIndex') : null
            ]
        ]);
    }

    /**
     * @throws StatamicEntryNotFoundException
     */
    public function showPage(Request $request, string $entryId): Response
    {
        $entry = Entry::whereInCollection(['blog'])->firstOrFail(
            function ($entry) use ($entryId) {
                return $entry->id === $entryId;
            }
        );

        if ($entry === null) {
            throw new StatamicEntryNotFoundException();
        }

        $comments = Comment::where('entry_id', $entryId)->get();

        return inertia('posts/show-page', [
            'entryId'        => $entryId,
            'title'          => $entry->title,
            'body'           => $entry->body,
            'headerImageUrl' => $entry->header_image?->url,
            'originUrl'      => $request->headers->get('originUrl') ?? route('pages.index'),
            'viewIndex'      => $request->headers->get('viewIndex') ? (int) $request->headers->get('viewIndex') : null,
            'tags'           => $entry->tags,
            'comments'       => CommentResource::collection($comments)
        ]);
    }
}
