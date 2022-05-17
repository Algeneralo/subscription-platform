<?php

namespace App\Http\Controllers\API;

use App\Models\Website;
use App\Events\PostCreatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Website $website)
    {
        return response()->json([
            'posts' => $website->posts
        ]);
    }

    public function store(StorePostRequest $storePostRequest, Website $website)
    {
        $data = $storePostRequest->validated();
        $hasFile = $storePostRequest->hasFile('image');
        if ($hasFile) {
            $uploadedFile = $storePostRequest->file('image');
            $filename = time() . $uploadedFile->getClientOriginalName();
            $path = Storage::putFileAs(
                'files',
                $uploadedFile,
                $filename
            );

            $data['image'] = $path;
        }
        $post = $website->posts()->create($data);


        return response()->json([
            'message' => 'Post created successfully',
            'data'    => $post
        ]);
    }
}