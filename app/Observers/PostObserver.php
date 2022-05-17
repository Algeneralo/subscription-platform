<?php

namespace App\Observers;

use App\Models\Post;
use App\Events\PostCreatedEvent;

class PostObserver
{
    public function created(Post $post)
    {
        PostCreatedEvent::dispatch($post);
    }

}