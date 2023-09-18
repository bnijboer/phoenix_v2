<?php

namespace App\Services;

use App\Enums\SubscriptionServiceEnum;
use App\Models\SubscribedEmail;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class SubscriptionService
{
    public function createSubscribedEmail(
        string $email,
        string $service,
        string $frequency
    ): Subscription
    {
        $subscribedEmail = SubscribedEmail::create([
            'email' => $email
        ]);

        return $this->createSubsciption(
            $subscribedEmail,
            $service,
            $frequency
        );
    }

    public function createSubsciption(
        User|SubscribedEmail $model,
        string $service,
        string $frequency
    ): Subscription
    {
        /** @var Subscription */
        return $model->subscriptions()->create([
            'subscribed_service' => $service,
            'frequency'          => $frequency
        ]);
    }

    public function getSubscriptionsByService(string $service): Collection
    {
        return Subscription::whereSubscribedService($service)->get();
    }

    public function getEmailAccountsSubscribedToNewsletter(): \Illuminate\Support\Collection
    {
        return $this
            ->getSubscriptionsByService(SubscriptionServiceEnum::NEWSLETTER)
            ->map(fn ($subscription) => $subscription->subscribable->email);
    }
}
