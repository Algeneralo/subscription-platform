<?php

namespace App\Http\Controllers\API;

use App\Models\Website;
use App\Models\WebsiteSubscriber;
use App\Http\Controllers\Controller;
use App\Http\Resources\WebsiteResource;
use App\Http\Requests\SubscribeWebsiteRequest;

class WebsiteController extends Controller
{
    public function index()
    {
        $websites = Website::all();

        return response()->json([
            'websites' => WebsiteResource::collection($websites)
        ]);
    }

    public function subscribe(SubscribeWebsiteRequest $subscribeWebsiteRequest, Website $website)
    {
        WebsiteSubscriber::query()->updateOrCreate([
            'email'      => $subscribeWebsiteRequest->email,
            'website_id' => $website->id
        ]);

        return response()->json();
    }
}