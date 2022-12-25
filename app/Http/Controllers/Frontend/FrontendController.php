<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Models\Announcement;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FrontendController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $footer_posts = Post::limit(5)
            ->published()
            ->latest()
            ->get();

        $sidebar_posts = Post::limit(5)
            ->published()
            ->inRandomOrder()
            ->get();

        $footer_announcements = Announcement::limit(5)
            ->published()
            ->latest()
            ->get();

        View::share('footer_posts', $footer_posts);
        View::share('sidebar_posts', $sidebar_posts);
        View::share('footer_announcements', $footer_announcements);
    }
}
