<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends FrontendController
{
    public function index()
    {
        $posts = Post::where('published_at', '!=', null)
            ->orderBy('id', 'desc')
            ->paginate(12)
            ->withQueryString();

        return view('frontend.pages.post.index', [
            'posts' => $posts
        ]);
    }

    public function show(Post $post)
    {
        $previous = Post::where('id', '<', $post->id)
            ->published()
            ->orderBy('id', 'desc')
            ->first();
        $next = Post::where('id', '>', $post->id)
            ->published()
            ->orderBy('id', 'asc')
            ->first();

        return view('frontend.pages.post.show', [
            'post' => $post,
            'nextPost' => $next,
            'prevPost' => $previous,
            'img' => $post->image,
            'title' => $post->title,
            'author' => $post->user->name,
            'desc' => $post->excerpt,
            'type' => 'article'
        ]);
    }
}
