<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Charts\ChartData;
use App\Models\SPMYearly;
use App\Helpers\DataHelper;
use Illuminate\Http\Request;
use App\Models\PriorityTarget;
use App\Models\PriorityYearly;
use App\Models\PriorityMonthly;
use Illuminate\Support\Facades\Schema;

class ChartController extends FrontendController
{
    public function index()
    {
        $priority = collect([
            ...DataHelper::INPUT_SASARAN,
            ...DataHelper::BULANAN_1,
            ...DataHelper::BULANAN_2,
            ...DataHelper::BULANAN_3,
            ...DataHelper::TAHUNAN_1,
            ...DataHelper::TAHUNAN_2
        ])->unique('attribute');

        $spm = DataHelper::SPM_TAHUNAN;

        return view('frontend.pages.chart.index', compact('priority', 'spm'));
    }

    public function show($year, $chart, Request $request)
    {
        if ($request->year_change)
            return redirect()
                ->route('chart.show', ['year' => $request->year_change, 'chart' => $chart]);

        $priority = collect([
            ...DataHelper::INPUT_SASARAN,
            ...DataHelper::BULANAN_1,
            ...DataHelper::BULANAN_2,
            ...DataHelper::BULANAN_3,
            ...DataHelper::TAHUNAN_1,
            ...DataHelper::TAHUNAN_2
        ])->unique('attribute')
            ->map(function ($q) use ($chart) {
                if ($q['attribute'] == $chart)
                    $active = true;
                else
                    $active = false;

                return [
                    'title' => $q['title'],
                    'attribute' => $q['attribute'],
                    'active' => $active,
                ];
            });

        $spm = collect(DataHelper::SPM_TAHUNAN)
            ->map(function ($q) use ($chart) {
                if ($q['attribute'] == $chart)
                    $active = true;

                $active = false;
                return [
                    'title' => $q['title'],
                    'attribute' => $q['attribute'],
                    'active' => $active,
                ];
            });

        if (Schema::hasColumn('priority_targets', $chart)) {
            $data = PriorityTarget::select($chart, 'user_id')
                ->where('tahun', $year)
                ->where('status_verifikasi', 2)
                ->get();
            $fieldset = DataHelper::INPUT_SASARAN;
            $dataset = 'Pelayanan Kesehatan';
            $table_name = 'PriorityTarget';
        }
        if (Schema::hasColumn('priority_monthlies', $chart)) {
            $data = PriorityMonthly::select($chart, 'user_id')
                ->where('tahun', $year)
                ->where('status_verifikasi', 2)
                ->get();
            $fieldset = [...DataHelper::BULANAN_1, ...DataHelper::BULANAN_2, ...DataHelper::BULANAN_3];
            $dataset = 'Pelayanan Kesehatan';
            $table_name = 'PriorityMonthly';
        }
        if (Schema::hasColumn('priority_yearlies', $chart)) {
            $data = PriorityYearly::select($chart, 'user_id')
                ->where('tahun', $year)
                ->where('status_verifikasi', 2)
                ->get();
            $fieldset = [...DataHelper::TAHUNAN_1, ...DataHelper::TAHUNAN_2];
            $dataset = 'Pelayanan Kesehatan';
            $table_name = 'PriorityYearly';
        }
        if (Schema::hasColumn('spm_targets', $chart)) {
            $data = SPMYearly::select($chart, 'user_id')
                ->where('tahun', $year)
                ->where('status_verifikasi', 2)
                ->get();
            $fieldset = DataHelper::SPM_TAHUNAN;
            $dataset = 'Standar Pelayanan Masyarakat';
            $table_name = 'SPMYearly';
        }

        $puskesmas = User::role('Puskesmas')
            ->get();

        $data = $puskesmas->map(
            function ($q) use ($data, $chart) {
                return [
                    'label' => $q->name,
                    'total' => $data->filter(function ($r) use ($q) {
                        return $r->user_id == $q->id;
                    })->first()->$chart ?? 0
                ];
            }
        )->toJson();

        $title = collect($fieldset)->where('attribute', $chart)
            ->first()['title'];

        // DUMMY DATA
        // $data = '[{"label":"PUSKESMAS 1","total":150},{"label":"PUSKESMAS 2","total":123},{"label":"PUSKESMAS 3","total":412},{"label":"PUSKESMAS 4","total":123},{"label":"PUSKESMAS 5","total":154},{"label":"PUSKESMAS 6","total":315},{"label":"PUSKESMAS 7","total":412},{"label":"PUSKESMAS 8","total":423},{"label":"PUSKESMAS 9","total":126},{"label":"PUSKESMAS 10","total":254}]';
        // ddd($data, $fieldset, $dataset, $chart, $title, $table_name, $priority, $spm);
        return view(
            'frontend.pages.chart.show',
            compact('data', 'title', 'dataset', 'year', 'priority', 'spm')
        );
    }
}
