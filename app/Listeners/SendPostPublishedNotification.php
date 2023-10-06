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
    public function handle(EntryCreated $event): void
    {
        logger('firing sendPostPublishedNotification listener');

        if ($event->entry instanceof Entry) {
            if ($event->entry->published()) {
                foreach ($this->subscriptionService->getEmailAccountsSubscribedToNewsletter() as $email) {
                    $this->subscriptionService->sendNewsletterMail($email, [
                        'title'          => $event->entry->get('title'),
                        'viewPostUrl'    => route('posts.show', $event->entry->id()),
                        'unsubscribeUrl' => route('newsletter.save_preferences')
                    ]);
                }
            }
        }
    }
}
