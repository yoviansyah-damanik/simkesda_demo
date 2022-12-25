<?php

namespace App\Http\Controllers;

use App\Models\Regency;
use App\Models\Village;
use App\Models\District;
use App\Models\Province;
use App\Helpers\DataHelper;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function provinces(Request $request)
    {
        if ($request->q) {
            return ["results" => collect(Province::where('name', 'like', "%$request->q%")->get())->map(function ($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->name
                ];
            })];
        }

        return ["results" => collect(Province::get())->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->name
            ];
        })];
    }

    public function regencies(Request $request)
    {
        $province_id = $request->province_id;
        $regencies = Regency::where('province_id', $province_id);

        if ($request->q) {
            return ["results" => collect($regencies->where('name', 'like', "%$request->q%")->get())->map(function ($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->name
                ];
            })];
        }

        return ["results" => collect($regencies->get())->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->name
            ];
        })];
    }

    public function districts(Request $request)
    {
        $regency_id = $request->regency_id;
        $districts = District::where('regency_id', $regency_id);

        if ($request->q) {
            return ["results" => collect($districts->where('name', 'like', "%$request->q%")->get())->map(function ($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->name
                ];
            })];
        }

        return ["results" => collect($districts->get())->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->name
            ];
        })];
    }

    public function villages(Request $request)
    {
        $district_id = $request->district_id;
        $villages = Village::where('district_id', $district_id);

        if ($request->q) {
            return ["results" => collect($villages->where('name', 'like', "%$request->q%")->get())->map(function ($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->name
                ];
            })];
        }

        return ["results" => collect($villages->get())->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->name
            ];
        })];
    }

    public function priority_data(Request $request)
    {
        $priority = collect([
            ...DataHelper::INPUT_SASARAN,
            ...DataHelper::BULANAN_1,
            ...DataHelper::BULANAN_2,
            ...DataHelper::BULANAN_3,
            ...DataHelper::TAHUNAN_1,
            ...DataHelper::TAHUNAN_2
        ])->unique('attribute');

        if ($request->q) {
            $data = collect([
                "results" => $priority->filter(function ($f) use ($request) {
                    return false !== stristr($f['title'], $request->q);
                })
                    ->map(function ($item) {
                        return [
                            'id' => $item['attribute'],
                            'text' => $item['title']
                        ];
                    })
            ]);
        } else {
            $data = collect([
                "results" => $priority->map(function ($item) {
                    return [
                        'id' => $item['attribute'],
                        'text' => $item['title']
                    ];
                })
            ]);
        }

        return $data->toJson();
    }

    public function spm_data(Request $request)
    {
        $spm = collect(DataHelper::SPM_TAHUNAN);

        if ($request->q) {
            $data = collect([
                "results" => $spm->filter(function ($f) use ($request) {
                    return false !== stristr($f['title'], $request->q);
                })
                    ->map(function ($item) {
                        return [
                            'id' => $item['attribute'],
                            'text' => $item['title']
                        ];
                    })
            ]);
        } else {
            $data = collect([
                "results" => $spm->map(function ($item) {
                    return [
                        'id' => $item['attribute'],
                        'text' => $item['title']
                    ];
                })
            ]);
        }

        return $data->toJson();
    }
}
