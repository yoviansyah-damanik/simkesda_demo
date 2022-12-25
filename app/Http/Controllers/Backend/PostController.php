<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PostController extends BackendController
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')
            ->paginate(config('app.pagination_length'))
            ->withQueryString();

        return view('backend.pages.posts.index', [
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return view('backend.pages.posts.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|max:255',
            'image' => 'image|max:2048',
            'body' => 'required'
        ]);

        // ddd($request->title);
        if ($request->file('image')) {
            $filename = date('Ymd') . '_' . Str::random(16) . '.' . $request->image->extension();
            $validateData['image'] = $request->file('image')->storeAs('post-images', $filename, 'public');
        }

        $validateData['user_id'] = auth()->user()->id;
        $validateData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        Post::create($validateData);

        Alert::success('Sukses!', 'Berita berhasil dibuat!');
        return redirect()
            ->route('dashboard.post');
    }

    public function edit(Post $post)
    {
        return view('backend.pages.posts.edit', [
            'post' => $post
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $rules = [
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'image|max:2048'
        ];

        if ($request->title != $post->title) {
            $rules['slug'] = SlugService::createSlug(Post::class, 'slug', $request->title);
        }

        $validateData = $request->validate($rules);

        if ($request->file('image')) {
            if ($post->image) {
                Storage::delete($post->image);
            }
            $filename = date('Ymd') . '_' . Str::random(16) . '.' . $request->image->extension();
            $validateData['image'] = $request->file('image')->storeAs('post-images', $filename);
        }

        $validateData['user_id'] = auth()->user()->id;
        $validateData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        $post->slug = null;
        $post->update($validateData);

        Alert::success('Sukses!', 'Berita berhasil diperbaharui.');
        return redirect()
            ->route('dashboard.post.edit', $post->slug);
    }

    public function publish(Request $request)
    {
        $id = $request->id;
        $stat = $request->stat;

        $data = Post::findOrFail($id);

        if ($stat == 0)
            $publish = null;
        else
            $publish = Carbon::now();

        $data->update(['published_at' => $publish]);

        if ($publish)
            $msg = 'Berita berhasil diterbitkan.';
        else
            $msg = 'Terbitan berita berhasil dibatalkan.';

        Alert::success('Sukses!', $msg);
        return redirect()
            ->route('dashboard.post');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        Alert::success('Sukses!', 'Berhasil menghapus berita.');
        return redirect()
            ->route('dashboard.post');
    }
}
