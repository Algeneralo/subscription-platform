<?php

namespace Database\Factories;

use App\Models\WebsiteSubscriber;
use Illuminate\Database\Eloquent\Factories\Factory;

class WebsiteSubscriberFactory extends Factory
{
    protected $model = WebsiteSubscriber::class;

    public function definition(): array
    {
        return [
            'website_id' => WebsiteFactory::new(),
            'email'      => $this->faker->unique()->safeEmail()
        ];
    }
}
