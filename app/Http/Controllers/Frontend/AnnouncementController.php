<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;

class AnnouncementController extends FrontendController
{
    public function index()
    {
        $announcements = Announcement::where('published_at', '!=', null)
            ->orderBy('id', 'desc')
            ->paginate(9)
            ->withQueryString();

        return view('frontend.pages.announcement.index', [
            'announcements' => $announcements
        ]);
    }

    public function show(Announcement $announcement)
    {
        $previous = Announcement::where('id', '<', $announcement->id)
            ->published()
            ->orderBy('id', 'desc')
            ->first();
        $next = Announcement::where('id', '>', $announcement->id)
            ->published()
            ->orderBy('id', 'asc')
            ->first();

        return view('frontend.pages.announcement.show', [
            'announcement' => $announcement,
            'nextAnnouncement' => $next,
            'prevAnnouncement' => $previous,
            'title' => $announcement->title,
            'author' => $announcement->user->name,
            'desc' => $announcement->excerpt,
            'type' => 'article'
        ]);
    }
}
