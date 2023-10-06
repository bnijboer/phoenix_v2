<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Services\SubscriptionService;
use Illuminate\Http\Response;

class SubscriptionController extends Controller
{
    public function __construct(
        private SubscriptionService $subscriptionService
    ) {}

    public function savePreferences(SubscriptionRequest $subscriptionRequest): Response
    {
        $this->subscriptionService->savePreferences($subscriptionRequest);

        return response('true')->cookie('quit_newsletter_prompting', true, 360, null, null, false, false);
    }
}
