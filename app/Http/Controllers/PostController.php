<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostPreviewResource;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use Statamic\Facades\Entry;
use Symfony\Component\HttpFoundation\JsonResponse;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $entry = Entry::query()
            ->where('collection', 'blog')
            ->forPage(
                $request->query('page'),
                $request->query('limit')
            )
            ->orderBy('date', 'desc')
            ->get();

        return new JsonResponse([
            'collection' => PostPreviewResource::collection($entry),
            'meta' => [
                'page' => (int) $request->query('page'),
                'total' => Entry::whereCollection('blog')->count(),
            ]
        ]);
    }

    public function show(Request $request, string $id)
    {
        $entry = Entry::find($id);

        $postDto = new PostResource($entry);

        return new JsonResponse($postDto);
    }
}
