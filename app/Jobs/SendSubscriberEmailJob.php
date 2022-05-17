<?php

namespace App\Jobs;

use App\Models\Post;
use App\Mail\NewPost;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendSubscriberEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public array $emails, public Post $post)
    {

    }

    public function handle()
    {
        $post = $this->post;
        foreach ($this->emails as $email) {
            try {
                Mail::to($email)->send(new NewPost($post));
            } catch (\Exception $exception) {
                Log::critical('Something went wrong with the email sending', [
                    'email'     => $email,
                    'exception' => $exception,
                ]);
            }
        }
    }
}