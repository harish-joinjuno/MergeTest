<?php

namespace App\Http\Controllers;

use App\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogPostController extends Controller
{
    public function index()
    {
        $title       = 'Financial Literacy';
        $description = 'Articles and media we’ve created to help you understand everything in your
            financial future.';
        $posts = BlogPost::all();

        return view('blog.section-index',
            compact('title', 'description', 'posts'));
    }

    public function show($slug)
    {
        $post = BlogPost::where('slug', $slug)->firstOrFail();

        return view('blog.post', compact('post') );
    }
}
