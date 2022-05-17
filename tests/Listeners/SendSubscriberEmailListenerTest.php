<?php

namespace Tests\Listeners;


use Tests\TestCase;
use App\Events\PostCreatedEvent;
use Database\Factories\PostFactory;
use App\Jobs\SendSubscriberEmailJob;
use Illuminate\Support\Facades\Queue;
use Database\Factories\WebsiteSubscriberFactory;

class SendSubscriberEmailListenerTest extends TestCase
{
    public function test_it_dispatch_job()
    {
        Queue::fake();

        WebsiteSubscriberFactory::new()->create(['website_id' => 6]);
        PostFactory::new()->create();

        Queue::assertPushed(SendSubscriberEmailJob::class);
    }
}
