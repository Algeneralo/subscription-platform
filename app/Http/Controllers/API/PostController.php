<?php

namespace App\Http\Controllers\API;

use App\Models\Website;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function store(StorePostRequest $storePostRequest, Website $website)
    {
        $website->posts()->create($storePostRequest->validated());
    }
}