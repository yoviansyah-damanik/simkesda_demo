<?php

namespace App\Helpers;

use App\Models\Post;
use Illuminate\Support\Str;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Models\PuskesmasProfile;

class UrlHelper
{
    public static function frontend_breadcrumb($segment, $current_route)
    {
        $route = explode('.', $current_route)[0];
        $segment_total = count($segment);

        if ($route == 'post' && $segment_total > 1) {
            $post_title = Post::where('slug', $segment[1])->first()->title;
        }

        if ($route == 'announcement' && $segment_total > 1) {
            $post_title = Announcement::where('slug', $segment[1])->first()->title;
        }

        if ($route == 'puskesmas' && $segment_total > 1) {
            $puskesmas = PuskesmasProfile::where('slug', $segment[1])->first();
            $post_title = $puskesmas->nama_puskesmas . ' - ' . $puskesmas->tahun;
        }

        if ($route == 'chart' && $segment_total > 1) {
            $priority = collect([
                ...DataHelper::INPUT_SASARAN,
                ...DataHelper::BULANAN_1,
                ...DataHelper::BULANAN_2,
                ...DataHelper::BULANAN_3,
                ...DataHelper::TAHUNAN_1,
                ...DataHelper::TAHUNAN_2
            ])->unique('attribute');

            $spm = DataHelper::SPM_TAHUNAN;

            $fieldset = collect([...$priority, ...$spm]);

            $post_title = collect($fieldset)->where('attribute', $segment[2])
                ->first()['title'] . " ($segment[1])";
            // $post_title = $segment[1];
        }

        $result = collect([
            [
                'title' => 'Beranda',
                'href' => route('homepage')
            ],
            [
                'title' => Str::of($segment[0])
                    ->replace('_', ' ')
                    ->explode(' ')
                    ->map(function ($item) {
                        return Str::ucfirst($item);
                    })
                    ->implode(' '),
                'href' => route($route)
            ]
        ]);

        if ($segment_total > 1) {
            $result->push(
                [
                    'title' => $post_title
                ]
            );
        }

        return $result;
    }

    public static function backend_breadcrumb($segment, $current_route)
    {
        $route = $current_route;
        $segment = collect($segment)
            ->flatten()
            ->map(function ($q) {
                if ($q == 'spm')
                    return 'SPM';

                if ($q == 'dashboard')
                    return 'Dasbor';

                return $q;
            });

        $segment_total = $segment->count();

        $result = collect([]);

        foreach ($segment as $key => $item) {
            if ($key == 3)
                break;

            if ($segment_total != ($key + 1))
                $route_name = Str::of($route)
                    ->explode('.')
                    ->take(2)
                    ->flatten()
                    ->take($key + 1)
                    ->implode('.');

            $result->push(
                [
                    'title' => Str::of($item)
                        ->replace('_', ' ')
                        ->explode(' ')
                        ->map(function ($q) {
                            return Str::ucfirst($q);
                        })
                        ->implode(' '),
                    'href' => route($route_name ?? 'dashboard')
                ]
            );
        }

        // ddd($route, $segment, $segment_total);
        return $result;
    }

    public static function backend_title_page($segment, $current_route)
    {
        $segment = collect($segment);
        $segment_total = $segment
            ->count();

        if ($segment_total > 2) {
            $segment = $segment->skip(2);
            $result = $segment->first();
        } else {
            $result = $segment->last();
        }

        return Str::of($result)
            ->replace('_', ' ')
            ->explode(' ')
            ->map(function ($q) {
                return Str::ucfirst($q);
            })
            ->implode(' ');
    }
}
