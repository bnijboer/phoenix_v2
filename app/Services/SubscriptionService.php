<?php

namespace App\Services;

use App\Enums\SubscriptionFrequencyEnum;
use App\Enums\SubscriptionServiceEnum;
use App\Http\Requests\SubscriptionRequest;
use App\Mail\NewsletterMail;
use App\Models\SubscribedEmail;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Mail;

class SubscriptionService
{
    public function savePreferences(SubscriptionRequest $subscriptionRequest): void
    {
        if ($subscriptionRequest->quitPrompting) {
            return;
        }

        if ($subscriptionRequest->unsubscribe) {
            $this->unsubscribe($subscriptionRequest->email);
        } else {
            $this->createSubscribedEmail(
                email:     $subscriptionRequest->email,
                service:   SubscriptionServiceEnum::NEWSLETTER,
                frequency: SubscriptionFrequencyEnum::IMMEDIATE
            );
        }
    }

    private function unsubscribe(string $email): void
    {
        Subscription::where([
            'email' => $email,
            'subscribed_service' => SubscriptionServiceEnum::NEWSLETTER,
        ])->delete();
    }

    public function createSubscribedEmail(
        string $email,
        string $service,
        string $frequency
    ): Subscription {
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
    ): Subscription {
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

    public function sendNewsletterMail(string $email, $params): void
    {
        logger('firing sendNewsletterMail');

        Mail::to($email)->send(
            new NewsletterMail(
                $params['title'],
                $params['viewPostUrl'],
                $params['unsubscribeUrl']
            )
        );
    }
}
