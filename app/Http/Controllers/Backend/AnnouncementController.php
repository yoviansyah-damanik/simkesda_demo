<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Cviebrock\EloquentSluggable\Services\SlugService;

class AnnouncementController extends BackendController
{
    public function index()
    {
        $announcements = Announcement::latest()
            ->paginate(config('app.pagination_length'))
            ->withQueryString();

        return view('backend.pages.announcement.index', [
            'announcements' => $announcements
        ]);
    }

    public function create()
    {
        return view('backend.pages.announcement.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        // ddd($request->title);
        $slug = SlugService::createSlug(Announcement::class, 'slug', $request->title);
        $validateData['slug'] = $slug;

        $validateData['user_id'] = auth()->user()->id;
        $validateData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        Announcement::create($validateData);

        Alert::success('Sukses!', 'Pengumuman berhasil dibuat!');
        return redirect()
            ->route('dashboard.announcement');
    }

    public function edit(Announcement $announcement)
    {
        return view('backend.pages.announcement.edit', [
            'announcement' => $announcement
        ]);
    }

    public function update(Request $request, Announcement $announcement)
    {
        $rules = [
            'title' => 'required|max:255',
            'body' => 'required',
        ];

        if ($request->title != $announcement->title) {
            $rules['slug'] = SlugService::createSlug(Announcement::class, 'slug', $request->title);
        }

        $validateData = $request->validate($rules);

        $validateData['user_id'] = auth()->user()->id;
        $validateData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        Announcement::where('id', $announcement->id)
            ->update($validateData);

        Alert::success('Sukses!', 'Pengumuman berhasil diubah!');
        return redirect()
            ->route('dashboard.announcement');
    }

    public function publish(Request $request)
    {
        $id = $request->id;
        $stat = $request->stat;

        $data = Announcement::findOrFail($id);

        if ($stat == 0)
            $publish = null;
        else
            $publish = Carbon::now();

        $data->update(['published_at' => $publish]);
        Alert::success('Sukses!', 'Berhasil mengubah status pengumuman.');
        return redirect()
            ->route('dashboard.announcement');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        Alert::success('Sukses!', 'Berhasil menghapus pengumuman.');
        return redirect()
            ->route('dashboard.announcement');
    }
}
