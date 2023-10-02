<?php

namespace App\Listeners;

use App\Services\SubscriptionService;
use Statamic\Entries\Entry;
use Statamic\Events\EntryCreated;

class SendPostPublishedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        private SubscriptionService $subscriptionService
    ) {
    }

    /**
     * Handle the event.
     *
     * @param EntryCreated $event
     * @return void
     */
    public function handle(EntryCreated $event)
    {
        if ($event->entry instanceof Entry) {
            if ($event->entry->published()) {
                $subscribedEmailAccounts = $this->subscriptionService->getEmailAccountsSubscribedToNewsletter();

                dd($subscribedEmailAccounts);
            }
        }
    }
}
