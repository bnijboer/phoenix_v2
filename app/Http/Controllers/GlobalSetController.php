<?php

namespace App\Http\Controllers;

use App\Http\Resources\AboutResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Statamic\Facades\GlobalSet;

class GlobalSetController extends Controller
{
    public function about(Request $request)
    {
        $about = GlobalSet::findByHandle('about_me')->inDefaultSite();

        return new JsonResponse([
            'about' => new AboutResource($about)
        ]);
    }
}
