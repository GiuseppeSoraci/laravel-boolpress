<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    /**
     * Get Blog Posts (archive)
     */
    public function index()
    {
        $posts = Post::paginate(4);

        return response()->json($posts);
    }

    // Get Post Detail By Slug
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->with(['category', 'tags'])->first();

        return response()->json($post);
    }
}
