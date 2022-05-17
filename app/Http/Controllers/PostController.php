<?php

namespace App\Http\Controllers;

use App\Models\Website;

class PostController extends Controller
{
    public function index(Website $website)
    {
        return view('posts.index', [
            'website' => $website
        ]);
    }
}