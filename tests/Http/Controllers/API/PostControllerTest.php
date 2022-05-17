<?php

namespace Tests\Http\Controllers\API;


use Tests\TestCase;
use App\Events\PostCreatedEvent;
use Illuminate\Support\Facades\Event;
use Database\Factories\WebsiteFactory;

class PostControllerTest extends TestCase
{
    public function test_it_can_create_post()
    {
        WebsiteFactory::new()->create();
        $this->postJson('/api/v1/websites/1/posts', [
            'title'       => 'Fake title',
            'description' => 'Fake description',
        ])->assertSuccessful();

        $this->assertDatabaseHas('posts', [
            'website_id'  => '1',
            'title'       => 'Fake title',
            'description' => 'Fake description',
        ]);
    }

    public function test_it_dispatch_event()
    {
        Event::fake([PostCreatedEvent::class]);

        WebsiteFactory::new()->create();
        $this->postJson('/api/v1/websites/1/posts', [
            'title'       => 'Fake title',
            'description' => 'Fake description',
        ])->assertSuccessful();

        Event::assertDispatchedTimes(PostCreatedEvent::class);
    }
}
