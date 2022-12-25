<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\PuskesmasProfile;
use RealRashid\SweetAlert\Facades\Alert;

class PuskesmasProfileController extends FrontendController
{
    public function index(Request $request)
    {
        $cari = $request->cari;

        if ($cari)
            $latestProfil = PuskesmasProfile::select('user_id')
                ->where('nama_puskesmas', 'like', '%' . $cari . '%')
                ->selectRaw('MAX(tahun) as latestProfil')
                ->groupBy('user_id')
                ->get();
        else
            $latestProfil = PuskesmasProfile::select('user_id', 'id')
                ->selectRaw('MAX(tahun) as latestProfil')
                ->groupBy('user_id')
                ->get();

        $whereIn = [];
        foreach ($latestProfil as $last) {
            array_push($whereIn, $last->id);
        }

        $puskesmas = PuskesmasProfile::whereIn('id', $whereIn)
            ->orderBy('nama_puskesmas', 'asc')
            ->paginate(10)
            ->withQueryString();

        return view('frontend.pages.puskesmas_profile.index', [
            'puskesmas' => $puskesmas,
            'cari' => $cari
        ]);
    }

    public function show(PuskesmasProfile $puskesmas_profile)
    {
        $years = PuskesmasProfile::select(['tahun', 'slug'])
            ->where('user_id', $puskesmas_profile->user->id)
            ->orderBy('tahun', 'desc')
            ->get();

        return view('frontend.pages.puskesmas_profile.show', [
            'puskesmas' => $puskesmas_profile,
            'years' => $years
        ]);
    }
}
