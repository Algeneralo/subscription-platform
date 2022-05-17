<?php

namespace App\Listeners;

use App\Events\PostCreatedEvent;
use App\Models\WebsiteSubscriber;
use App\Jobs\SendSubscriberEmailJob;

class SendSubscriberEmailListener
{
    public function handle(PostCreatedEvent $event)
    {

        $post = $event->post;
        WebsiteSubscriber::query()
            ->where('website_id', $post->website_id)
            ->chunk(200, function ($websiteSubscribers) use ($post) {
                SendSubscriberEmailJob::dispatch($websiteSubscribers->pluck('email')->toArray(), $post);
            });
    }
}