<?php

namespace App\Http\Controllers;

use App\Http\Resources\AboutResource;
use Statamic\Facades\GlobalSet;

class GlobalSetController extends Controller
{
    public function about(): AboutResource
    {
        return new AboutResource(
            GlobalSet::findByHandle('about_me')->inDefaultSite()
        );
    }
}
