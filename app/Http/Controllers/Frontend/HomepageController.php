<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Models\User;
use App\Models\Slider;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Models\PuskesmasProfile;

class HomepageController extends FrontendController
{
    public function index()
    {
        $count_1 = User::role('Puskesmas')
            ->count();

        $count_2 = PuskesmasProfile::selectRaw('sum(jml_poskesdes) as jml_poskesdes')
            ->where('tahun', date('Y'))
            ->first()->jml_poskesdes;
        $count_3 = PuskesmasProfile::selectRaw('sum(jml_poskestren) as jml_poskestren')
            ->where('tahun', date('Y'))
            ->first()->jml_poskestren;
        $count_4 = PuskesmasProfile::selectRaw('sum(jml_posbindu_ptm_aktif) as jml_posbindu_ptm_aktif')
            ->where('tahun', date('Y'))
            ->first()->jml_posbindu_ptm_aktif;
        $count_5 = PuskesmasProfile::selectRaw('sum(jml_posyandu) as jml_posyandu')
            ->where('tahun', date('Y'))
            ->first()->jml_posyandu;
        $count_6 = PuskesmasProfile::selectRaw('sum(jml_posyandu_lansia) as jml_posyandu_lansia')
            ->where('tahun', date('Y'))
            ->first()->jml_posyandu_lansia;

        $counts = [
            [
                'label' => 'Puskesmas',
                'count' => $count_1
            ],
            [
                'label' => 'Poskesdes',
                'count' => $count_2
            ],
            [
                'label' => 'Poskestren',
                'count' => $count_3
            ],
            [
                'label' => 'Posbindu',
                'count' => $count_4
            ],
            [
                'label' => 'Posyandu',
                'count' => $count_5
            ],
            [
                'label' => 'Posy. Lansia',
                'count' => $count_6
            ]
        ];

        $posts = Post::limit(6)
            ->published()
            ->orderBy('published_at', 'desc')
            ->get();

        $announcements = Announcement::limit(6)
            ->published()
            ->orderBy('published_at', 'desc')
            ->get();

        $sliders = Slider::orderBy('priority', 'asc')
            ->get();

        return view('frontend.pages.index', [
            'counts' => $counts,
            'posts' => $posts,
            'announcements' => $announcements,
            'sliders' => $sliders
        ]);
    }
}
