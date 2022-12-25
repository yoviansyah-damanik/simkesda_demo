<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\User;
use App\Helpers\DataHelper;
use App\Models\DataHistory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PriorityTarget;
use App\Models\PriorityYearly;
use App\Models\PriorityMonthly;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use \PDF;

class PriorityController extends BackendController
{
    public function index()
    {
        $prioritas_sasaran = PriorityTarget::get();
        $prioritas_bulanan = PriorityMonthly::get();
        $prioritas_tahunan = PriorityYearly::get();

        if (Auth::user()->role_name == 'Puskesmas')
            $sasaran_count = $prioritas_sasaran->where('user_id', Auth::id())
                ->count();
        else
            $sasaran_count = $prioritas_sasaran->count();

        $sasaran_count = $sasaran_count > 0 ? $sasaran_count : 1;

        $sasaran_0 = $prioritas_sasaran->where('status_verifikasi', 0);
        if (Auth::user()->role_name == 'Puskesmas')
            $sasaran_0 = $sasaran_0->where('user_id', Auth::id());

        $sasaran_0 = $sasaran_0->count();

        $sasaran_1 = $prioritas_sasaran->where('status_verifikasi', 1);
        if (Auth::user()->role_name == 'Puskesmas')
            $sasaran_1 = $sasaran_1->where('user_id', Auth::id());

        $sasaran_1 = $sasaran_1->count();

        $sasaran_2 = $prioritas_sasaran->where('status_verifikasi', 2);
        if (Auth::user()->role_name == 'Puskesmas')
            $sasaran_2 = $sasaran_2->where('user_id', Auth::id());

        $sasaran_2 = $sasaran_2->count();

        $sasaran_3 = $prioritas_sasaran->where('status_verifikasi', 3);
        if (Auth::user()->role_name == 'Puskesmas')
            $sasaran_3 = $sasaran_3->where('user_id', Auth::id());

        $sasaran_3 = $sasaran_3->count();

        if (Auth::user()->role_name == 'Puskesmas')
            $bulanan_count = $prioritas_bulanan->where('user_id', Auth::id())
                ->count();
        else
            $bulanan_count = $prioritas_bulanan->count();

        $bulanan_count  = $bulanan_count > 0 ? $bulanan_count : 1;

        $bulanan_0 = $prioritas_bulanan->where('status_verifikasi', 0);
        if (Auth::user()->role_name == 'Puskesmas')
            $bulanan_0 = $bulanan_0->where('user_id', Auth::id());

        $bulanan_0 = $bulanan_0->count();

        $bulanan_1 = $prioritas_bulanan->where('status_verifikasi', 1);
        if (Auth::user()->role_name == 'Puskesmas')
            $bulanan_1 = $bulanan_1->where('user_id', Auth::id());

        $bulanan_1 = $bulanan_1->count();

        $bulanan_2 = $prioritas_bulanan->where('status_verifikasi', 2);
        if (Auth::user()->role_name == 'Puskesmas')
            $bulanan_2 = $bulanan_2->where('user_id', Auth::id());

        $bulanan_2 = $bulanan_2->count();

        $bulanan_3 = $prioritas_bulanan->where('status_verifikasi', 3);
        if (Auth::user()->role_name == 'Puskesmas')
            $bulanan_3 = $bulanan_3->where('user_id', Auth::id());

        $bulanan_3 = $bulanan_3->count();

        if (Auth::user()->role_name == 'Puskesmas')
            $tahunan_count = $prioritas_tahunan->where('user_id', Auth::id())
                ->count();
        else
            $tahunan_count = $prioritas_tahunan->count();

        $tahunan_count = $tahunan_count > 0 ? $tahunan_count : 1;

        $tahunan_0 = $prioritas_tahunan->where('status_verifikasi', 0);
        if (Auth::user()->role_name == 'Puskesmas')
            $tahunan_0 = $tahunan_0->where('user_id', Auth::id());

        $tahunan_0 = $tahunan_0->count();

        $tahunan_1 = $prioritas_tahunan->where('status_verifikasi', 1);
        if (Auth::user()->role_name == 'Puskesmas')
            $tahunan_1 = $tahunan_1->where('user_id', Auth::id());

        $tahunan_1 = $tahunan_1->count();

        $tahunan_2 = $prioritas_tahunan->where('status_verifikasi', 2);
        if (Auth::user()->role_name == 'Puskesmas')
            $tahunan_2 = $tahunan_2->where('user_id', Auth::id());

        $tahunan_2 = $tahunan_2->count();

        $tahunan_3 = $prioritas_tahunan->where('status_verifikasi', 3);
        if (Auth::user()->role_name == 'Puskesmas')
            $tahunan_3 = $tahunan_3->where('user_id', Auth::id());

        $tahunan_3 = $tahunan_3->count();

        $prioritas = [
            "priority_target" => [
                'label' => 'Template Prioritas - Data Sasaran',
                'items' => [
                    ['item' => $sasaran_1, 'type' => 1, 'link' => route('dashboard.priority.target', ['filter' => 'proses_pemeriksaan']), 'percentage' => ($sasaran_1 / $sasaran_count * 100)],
                    ['item' => $sasaran_2, 'type' => 2, 'link' => route('dashboard.priority.target', ['filter' => 'verifikasi']), 'percentage' => ($sasaran_2 / $sasaran_count * 100)],
                    ['item' => $sasaran_3, 'type' => 3, 'link' => route('dashboard.priority.target', ['filter' => 'periksa_ulang']), 'percentage' => ($sasaran_3 / $sasaran_count * 100)],
                ]
            ],
            "priority_monthly" => [
                'label' => 'Template Prioritas - Data Bulanan',
                'items' => [
                    ['item' => $bulanan_1, 'type' => 1, 'link' => route('dashboard.priority.monthly', ['filter' => 'proses_pemeriksaan']), 'percentage' => ($bulanan_1 / $bulanan_count * 100)],
                    ['item' => $bulanan_2, 'type' => 2, 'link' => route('dashboard.priority.monthly', ['filter' => 'verifikasi']), 'percentage' => ($bulanan_2 / $bulanan_count * 100)],
                    ['item' => $bulanan_3, 'type' => 3, 'link' => route('dashboard.priority.monthly', ['filter' => 'periksa_ulang']), 'percentage' => ($bulanan_3 / $bulanan_count * 100)],
                ]
            ],
            "priority_yearly" => [
                'label' => 'Template Prioritas - Data Tahunan',
                'items' => [
                    ['item' => $tahunan_1, 'type' => 1, 'link' => route('dashboard.priority.yearly', ['filter' => 'proses_pemeriksaan']), 'percentage' => ($tahunan_1 / $tahunan_count * 100)],
                    ['item' => $tahunan_2, 'type' => 2, 'link' => route('dashboard.priority.yearly', ['filter' => 'verifikasi']), 'percentage' => ($tahunan_2 / $tahunan_count * 100)],
                    ['item' => $tahunan_3, 'type' => 3, 'link' => route('dashboard.priority.yearly', ['filter' => 'periksa_ulang']), 'percentage' => ($tahunan_3 / $tahunan_count * 100)],
                ]
            ],
        ];

        if (Auth::user()->role_name == 'Puskesmas') {
            array_unshift(
                $prioritas['priority_target']['items'],
                ['item' => $sasaran_0, 'type' => 0, 'link' => route('dashboard.priority.target', ['filter' => 'draft']), 'percentage' => ($sasaran_0 / $sasaran_count * 100)],
            );
            array_unshift(
                $prioritas['priority_monthly']['items'],
                ['item' => $bulanan_0, 'type' => 0, 'link' => route('dashboard.priority.monthly', ['filter' => 'draft']), 'percentage' => ($bulanan_1 / $sasaran_count * 100)],
            );
            array_unshift(
                $prioritas['priority_yearly']['items'],
                ['item' => $tahunan_0, 'type' => 0, 'link' => route('dashboard.priority.yearly', ['filter' => 'draft']), 'percentage' => ($tahunan_2 / $sasaran_count * 100)],
            );
        }


        return view('backend.pages.priority.index', [
            'data' => $prioritas
        ]);
    }

    public function report()
    {
        if (Auth::user()->role_name == 'Puskesmas') {
            return view('backend.pages.priority.report.user');
        } else {
            $users = User::role('Puskesmas')
                ->get();

            return view('backend.pages.priority.report.admin', compact('users'));
        }
    }

    public function download_user(Request $request)
    {
        $template = $request->template_prioritas;
        $tahun = $request->tahun;

        if ($template == 'data_sasaran') {
            $data = PriorityTarget::where('user_id', Auth::id())
                ->where('status_verifikasi', 2)
                ->where('tahun', $tahun);

            if ($data->count() == 0) {
                Alert::warning('Perhatian!', 'Data Template Prioritas - Data Sasaran pada tahun tersebut tidak ditemukan.');
                return redirect()
                    ->route('dashboard.priority.report')
                    ->withInput();
            } else {
                $data = $data->first();
            }

            if ($tahun == 'semua_tahun')
                $tahun = 'Semua Tahun';

            $pdf = PDF::loadview('backend.pages.report.user.cetak_prioritas_sasaran', [
                'data' => $data,
                'tahun' => $tahun,
                'agent' => $this->agent,
                'att' => DataHelper::INPUT_SASARAN
            ]);

            return $pdf->download(Auth::user()->name . "_Laporan Template Prioritas_Data Sasaran_Tahun ${tahun}.pdf");
        } else if ($template == 'data_bulanan') {
            $bulan = $request->bulan;
            $atts_1 = DataHelper::BULANAN_1;
            $atts_2 = DataHelper::BULANAN_2;
            $atts_3 = DataHelper::BULANAN_3;
            $atts_4 = DataHelper::BULANAN_4;

            if ($bulan == 'semua_bulan') {
                $array_atts = [];
                for ($x = 1; $x <= 4; $x++) {
                    $array = ${'atts_' . $x};

                    foreach ($array as $val) {
                        array_push($array_atts, 'sum(' . $val['attribute'] . ') as ' . $val['attribute']);
                    }
                }
                $raw = join(', ', $array_atts);

                $data = PriorityMonthly::selectRaw('user_id, bulan, ' . $raw)
                    ->where('tahun', $tahun)
                    ->groupBy('user_id', 'bulan')
                    ->having('user_id', Auth::id())
                    ->where('status_verifikasi', 2);

                $bulan = 'Januari - Desember';
                $view = 'backend.pages.report.user.cetak_prioritas_bulanan_tahun';
                if ($data->count() == 0) {
                    Alert::warning('Perhatian!', 'Data Template Prioritas - Data Bulanan pada bulan dan tahun tersebut tidak ditemukan.');
                    return redirect()
                        ->route('dashboard.priority.report')
                        ->withInput();
                } else {
                    $data = $data->get();
                }

                $puskesmas = User::where('id', Auth::id())->first();

                $pdf = PDF::loadview($view, [
                    'data' => $data,
                    'agent' => $this->agent,
                    'puskesmas' => $puskesmas,
                    'tahun' => $tahun,
                    'bulan' => $bulan,
                    'atts_1' => $atts_1,
                    'atts_2' => $atts_2,
                    'atts_3' => $atts_3,
                    'atts_4' => $atts_4,
                    'label' => DataHelper::LABEL_BULANAN,
                ]);
                $pdf->setPaper('A4', 'Landscape');
                return $pdf->download(Auth::user()->name . "_Laporan Template Prioritas_Data Bulanan_Semua Bulan_Tahun ${tahun}.pdf");
            } else {
                $data = PriorityMonthly::where('user_id', Auth::id())
                    ->where('status_verifikasi', 2)
                    ->where('tahun', $tahun)
                    ->where('bulan', $bulan);

                if ($data->count() == 0) {
                    Alert::warning('Perhatian!', 'Data Template Prioritas - Data Bulanan pada bulan dan tahun tersebut tidak ditemukan.');
                    return redirect()
                        ->route('dashboard.priority.report')
                        ->withInput();
                } else {
                    $data = $data->first();
                }

                $pdf = PDF::loadview('backend.pages.report.user.cetak_prioritas_bulanan', [
                    'data' => $data,
                    'agent' => $this->agent,
                    'tahun' => $tahun,
                    'bulan' => Carbon::parse(date('Y-' . $bulan . '-01'))->translatedFormat('F'),
                    'atts_1' => $atts_1,
                    'atts_2' => $atts_2,
                    'atts_3' => $atts_3,
                    'atts_4' => $atts_4,
                    'label' => DataHelper::LABEL_TAHUNAN,
                ]);
                $bulan = Carbon::parse(date('Y-' . $bulan . '-01'))->translatedFormat('F');

                return $pdf->download(Auth::user()->name . "_Laporan Template Prioritas_Data Bulanan_Bulan ${bulan}_Tahun ${tahun}.pdf");
            }
        } else if ($template == 'data_tahunan') {
            $data = PriorityYearly::where('user_id', Auth::id())
                ->where('status_verifikasi', 2)
                ->where('tahun', $tahun);

            if ($data->count() == 0) {
                Alert::warning('Perhatian!', 'Data Template Prioritas - Data Tahunan pada tahun tersebut tidak ditemukan.');
                return redirect()
                    ->route('dashboard.priority.report')
                    ->withInput();
            } else {
                $data = $data->first();
            }

            $pdf = PDF::loadview('backend.pages.report.user.cetak_prioritas_tahunan', [
                'data' => $data,
                'agent' => $this->agent,
                'tahun' => $tahun,
                'atts_1' => DataHelper::TAHUNAN_1,
                'atts_2' => DataHelper::TAHUNAN_2,
                'label' => DataHelper::LABEL_TAHUNAN
            ]);
            return $pdf->download(Auth::user()->name . "_Laporan Template Prioritas_Data Tahunan_Tahun ${tahun}.pdf");
        }
    }

    public function download_admin(Request $request)
    {
        $template = $request->template_prioritas;
        $user = $request->user;
        $tahun = $request->tahun;

        if ($template == 'data_sasaran') {
            if ($user == 'semua_puskesmas') {
                $data = PriorityTarget::where('tahun', $tahun);

                if ($data->count() > 0) {
                    $data = $data->get();
                } else {
                    Alert::warning('Perhatian!', 'Data Template Prioritas - Data Sasaran pada tahun tersebut tidak ditemukan.');
                    return redirect()
                        ->route('dashboard.priority.report')
                        ->withInput();
                }

                $pdf = PDF::loadview('backend.pages.report.admin.cetak_prioritas_sasaran', [
                    'data' => $data,
                    'tahun' => $tahun,
                    'agent' => $this->agent,
                    'kadis' => $this->kadis,
                    'att' => DataHelper::INPUT_SASARAN
                ]);
                $pdf->setPaper('A4', 'Landscape');
                return $pdf->download("Semua Puskesmas_Laporan Prioritas_Data Sasaran_Tahun ${tahun}.pdf");
            } else {
                $data = PriorityTarget::where('user_id', $user)
                    ->where('status_verifikasi', 2)
                    ->where('tahun', $tahun);

                if ($data->count() == 0) {
                    Alert::warning('Perhatian!', 'Data Template Prioritas - Data Sasaran pada tahun tersebut tidak ditemukan.');
                    return redirect()
                        ->route('dashboard.priority.report')
                        ->withInput();
                } else {
                    $data = $data->first();
                }

                if ($tahun == 'semua_tahun')
                    $tahun = 'Semua Tahun';

                $pdf = PDF::loadview('backend.pages.report.admin.cetak_prioritas_sasaran_single', [
                    'data' => $data,
                    'tahun' => $tahun,
                    'agent' => $this->agent,
                    'att' => DataHelper::INPUT_SASARAN
                ]);
                $pdf->setPaper('A4', 'Portrait');
                return $pdf->download($data->user->name . "_Laporan Prioritas_Data Sasaran_Tahun ${tahun}.pdf");
            }
        } else if ($template == 'data_bulanan') {
            $bulan = $request->bulan;
            $atts_1 = DataHelper::BULANAN_1;
            $atts_2 = DataHelper::BULANAN_2;
            $atts_3 = DataHelper::BULANAN_3;
            $atts_4 = DataHelper::BULANAN_4;

            if ($user == 'semua_puskesmas') {
                if ($bulan == 'semua_bulan') {
                    $array_atts = [];
                    for ($x = 1; $x <= 4; $x++) {
                        $array = ${'atts_' . $x};

                        foreach ($array as $val) {
                            array_push($array_atts, 'sum(' . $val['attribute'] . ') as ' . $val['attribute']);
                        }
                    }
                    $raw = join(', ', $array_atts);

                    $data = PriorityMonthly::selectRaw('bulan, ' . $raw)
                        ->where('tahun', $tahun)
                        ->groupBy('bulan')
                        ->where('status_verifikasi', 2);

                    $bulan = 'Januari - Desember';
                    $file = "Semua Puskesmas_Laporan Prioritas_Data Bulanan_Semua Bulan_Tahun ${tahun}.pdf";
                    $view = 'backend.pages.report.admin.cetak_prioritas_bulanan_tahun';
                } else {
                    $data = PriorityMonthly::where('tahun', $tahun)
                        ->where('status_verifikasi', 2)
                        ->where('bulan', $bulan);

                    $bulan = Carbon::parse(date('Y-' . $bulan . '-01'))->translatedFormat('F');
                    $file = "Semua Puskesmas_Laporan Prioritas_Data Bulanan_Bulan ${bulan}_Tahun ${tahun}.pdf";
                    $view = 'backend.pages.report.admin.cetak_prioritas_bulanan';
                }

                if ($data->count() == 0) {
                    Alert::warning('Perhatian!', 'Data Template Prioritas - Data Bulanan pada bulan dan tahun tersebut tidak ditemukan.');
                    return redirect()
                        ->route('dashboard.priority.report')
                        ->withInput();
                } else {
                    $data = $data->get();
                }

                $puskesmas = 'Semua Puskesmas';

                $pdf = PDF::loadview(
                    $view,
                    [
                        'data' => $data,
                        'agent' => $this->agent,
                        'puskesmas' => $puskesmas,
                        'tahun' => $tahun,
                        'bulan' => $bulan,
                        'atts_1' => $atts_1,
                        'atts_2' => $atts_2,
                        'atts_3' => $atts_3,
                        'atts_4' => $atts_4,
                        'label' => DataHelper::LABEL_BULANAN,
                    ]
                );
                $pdf->setPaper('A4', 'Landscape');
                return $pdf->download($file);
            } else {
                if ($bulan == 'semua_bulan') {
                    $array_atts = [];
                    for ($x = 1; $x <= 4; $x++) {
                        $array = ${'atts_' . $x};

                        foreach ($array as $val) {
                            array_push($array_atts, 'sum(' . $val['attribute'] . ') as ' . $val['attribute']);
                        }
                    }
                    $raw = join(', ', $array_atts);

                    $data = PriorityMonthly::selectRaw('user_id, bulan, ' . $raw)
                        ->where('tahun', $tahun)
                        ->groupBy('user_id', 'bulan')
                        ->having('user_id', $user)
                        ->where('status_verifikasi', 2);

                    $bulan = 'Januari - Desember';
                    $view = 'backend.pages.report.admin.cetak_prioritas_bulanan_tahun_single';
                    if ($data->count() == 0) {
                        Alert::warning('Perhatian!', 'Data Template Prioritas - Data Bulanan pada bulan dan tahun tersebut tidak ditemukan.');
                        return redirect()
                            ->route('dashboard.priority.report')
                            ->withInput();
                    } else {
                        $data = $data->get();
                    }

                    $puskesmas = User::where('id', $user)->first();

                    $pdf = PDF::loadview($view, [
                        'data' => $data,
                        'agent' => $this->agent,
                        'puskesmas' => $puskesmas,
                        'tahun' => $tahun,
                        'bulan' => $bulan,
                        'atts_1' => $atts_1,
                        'atts_2' => $atts_2,
                        'atts_3' => $atts_3,
                        'atts_4' => $atts_4,
                        'label' => DataHelper::LABEL_BULANAN,
                    ]);
                    $pdf->setPaper('A4', 'Landscape');
                    return $pdf->download($data->user->name . "_Laporan Prioritas_Data Bulanan_Semua Bulan_Tahun ${tahun}.pdf");
                } else {
                    $data = PriorityMonthly::where('user_id', $user)
                        ->where('status_verifikasi', 2)
                        ->where('tahun', $tahun)
                        ->where('bulan', $bulan);

                    $bulan = Carbon::parse(date('Y-' . $bulan . '-01'))->translatedFormat('F');
                    $view = 'backend.pages.report.admin.cetak_prioritas_bulanan_single';

                    if ($data->count() == 0) {
                        Alert::warning('Perhatian!', 'Data Template Prioritas - Data Bulanan pada bulan dan tahun tersebut tidak ditemukan.');
                        return redirect()
                            ->route('dashboard.priority.report')
                            ->withInput();
                    } else {
                        $data = $data->first();
                    }

                    $puskesmas = User::where('id', $user)->first()->name;

                    $pdf = PDF::loadview($view, [
                        'data' => $data,
                        'agent' => $this->agent,
                        'puskesmas' => $puskesmas,
                        'tahun' => $tahun,
                        'bulan' => $bulan,
                        'atts_1' => $atts_1,
                        'atts_2' => $atts_2,
                        'atts_3' => $atts_3,
                        'atts_4' => $atts_4,
                        'label' => DataHelper::LABEL_BULANAN,
                    ]);
                    return $pdf->download($data->user->name . "_Laporan Prioritas_Data Bulanan_Bulan ${bulan}_Tahun ${tahun}.pdf");
                }
            }
        } else if ($template == 'data_tahunan') {
            if ($user == 'semua_puskesmas') {
                $data = PriorityYearly::where('tahun', $tahun);

                if ($data->count() > 0) {
                    $data = $data->get();
                } else {
                    Alert::warning('Perhatian!', 'Data Template Prioritas - Data Tahunan pada tahun tersebut tidak ditemukan.');
                    return redirect()
                        ->route('dashboard.priority.report')
                        ->withInput();
                }

                $pdf = PDF::loadview('backend.pages.report.admin.cetak_prioritas_tahunan', [
                    'data' => $data,
                    'tahun' => $tahun,
                    'agent' => $this->agent,
                    'kadis' => $this->kadis,
                    'atts_1' => DataHelper::TAHUNAN_1,
                    'atts_2' => DataHelper::TAHUNAN_2,
                    'label' => DataHelper::LABEL_TAHUNAN
                ]);

                $pdf->setPaper('A4', 'Landscape');
                return $pdf->download("Semua Puskesmas_Laporan Prioritas_Data Tahunan_Tahun ${tahun}.pdf");
            } else {
                $data = PriorityYearly::where('user_id', $user)
                    ->where('status_verifikasi', 2)
                    ->where('tahun', $tahun);

                if ($data->count() == 0) {
                    Alert::warning('Perhatian!', 'Data Template Prioritas - Data Tahunan pada tahun tersebut tidak ditemukan.');
                    return redirect()
                        ->route('dashboard.priority.report')
                        ->withInput();
                } else {
                    $data = $data->first();
                }

                $pdf = PDF::loadview('backend.pages.report.admin.cetak_prioritas_tahunan_single', [
                    'data' => $data,
                    'agent' => $this->agent,
                    'tahun' => $tahun,
                    'atts_1' => DataHelper::TAHUNAN_1,
                    'atts_2' => DataHelper::TAHUNAN_2,
                    'label' => DataHelper::LABEL_TAHUNAN
                ]);
                return $pdf->download($data->user->name . "_Laporan Prioritas_Data Tahunan_Tahun ${tahun}.pdf");
            }
        }
    }

    // **                   **
    // *    DATA SASARAN     *
    // **                   **

    public function target(Request $request)
    {
        $filter = $request->filter;
        $tahun = $request->tahun;

        if ($filter == 'semua_data' || !$filter)
            $where = [
                ['status_verifikasi', '!=', null]
            ];
        else if ($filter == 'draft')
            $where = [
                ['status_verifikasi', '=', 0]
            ];
        else if ($filter == 'proses_pemeriksaan')
            $where = [
                ['status_verifikasi', '=', 1]
            ];
        else if ($filter == 'verifikasi')
            $where = [
                ['status_verifikasi', '=', 2]
            ];
        else if ($filter == 'periksa_ulang')
            $where = [
                ['status_verifikasi', '=', 3]
            ];
        else
            return redirect()
                ->route('dashboard.priority.target');

        if ($tahun == 'semua_data' || !$tahun)
            array_push($where, ['tahun', '!=', null]);
        else
            array_push($where, ['tahun', '=', $tahun]);

        if (Auth::user()->role_name == 'Puskesmas')
            array_push($where, ['user_id', Auth::id()]);
        else
            array_push($where, ['status_verifikasi', '!=', 0]);

        $data = PriorityTarget::where($where)
            ->orderBy('tahun', 'desc')
            ->orderBy('status_verifikasi', 'asc')
            ->orderBy('waktu_pengajuan', 'asc')
            ->paginate(config('app.pagination_length'))->withQueryString();

        return view('backend.pages.priority.target.index', [
            'data' => $data,
            'tahun' => $tahun,
            'filter' => $filter
        ]);
    }

    public function target_show(PriorityTarget $priority_target)
    {
        if ((Auth::user()->role_name == 'Puskesmas' && $priority_target->user_id != Auth::id()) || (Auth::user()->role_name != 'Puskesmas' && $priority_target->status_verifikasi == 0))
            return redirect()->route('dashboard.priority.target');

        $riwayat = DataHistory::where('tipe_data', 'prioritas_data_sasaran')
            ->where('data_id', $priority_target->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('backend.pages.priority.target.show', [
            'data' => $priority_target,
            'att' => DataHelper::INPUT_SASARAN,
            'riwayat' => $riwayat
        ]);
    }

    public function target_create()
    {
        return view('backend.pages.priority.target.create', [
            'att' => DataHelper::INPUT_SASARAN,
        ]);
    }

    public function target_store(Request $request)
    {
        $data_sasaran = PriorityTarget::where('user_id', Auth::id())
            ->where('tahun', $request->tahun)
            ->count();

        if ($data_sasaran > 0) {
            Alert::info('Informasi!', 'Tahun tersebut telah ada sebelumnya. Silahkan periksa list Template Prioritas - Data Sasaran atau masukkan kembali tahun yang baru.');
            return redirect()
                ->route('dashboard.priority.target.create')
                ->withInput();
        }

        $validatedData = $request->validate(
            [
                'tahun' => 'required|numeric',
                'jml_penduduk' => 'required|numeric',
                'satuan_jml_penduduk' => 'required',
                'jml_bayi_lahir_hidup' => 'required|numeric',
                'satuan_jml_bayi_lahir_hidup' => 'required',
                'jml_bayi' => 'required|numeric',
                'satuan_jml_bayi' => 'required',
                'jml_balita' => 'required|numeric',
                'satuan_jml_balita' => 'required',
                'jml_anak_sd_1' => 'required|numeric',
                'satuan_jml_anak_sd_1' => 'required',
                'jml_anak_sd_2_3' => 'required|numeric',
                'satuan_jml_anak_sd_2_3' => 'required',
                'jml_anak_b_15_th' => 'required|numeric',
                'satuan_jml_anak_b_15_th' => 'required',
                'jml_wanita_subur' => 'required|numeric',
                'satuan_jml_wanita_subur' => 'required',
                'jml_ibu_hamil' => 'required|numeric',
                'satuan_jml_ibu_hamil' => 'required',
                'jml_ibu_bersalin' => 'required|numeric',
                'satuan_jml_ibu_bersalin' => 'required',
                'jml_desa' => 'required|numeric',
                'satuan_jml_desa' => 'required'
            ],
            [],
            [
                'jml_penduduk' => 'Jumlah penduduk',
                'satuan_jml_penduduk' => 'Satuan jumlah penduduk',
                'jml_bayi_lahir_hidup' => 'Jumlah bayi lahir hidup',
                'satuan_jml_bayi_lahir_hidup' => 'Satuan jumlah bayi lahir hidup',
                'jml_bayi' => 'Jumlah bayi',
                'satuan_jml_bayi' => 'Satuan jumlah bayi',
                'jml_balita' => 'Jumlah balita',
                'satuan_jml_balita' => 'Satuan jumlah balita',
                'jml_anak_sd_1' => 'Jumlah anak SD kelas 1',
                'satuan_jml_anak_sd_1' => 'Satuan jumlah anak SD kelas 1',
                'jml_anak_sd_2_3' => 'Jumlah anak SD kelas 2 dan 3',
                'satuan_jml_anak_sd_2_3' => 'Satuan jumlah anak SD kelas 2 dan 3',
                'jml_anak_b_15_th' => 'Jumlah anak bawah 15 tahun',
                'satuan_jml_anak_b_15_th' => 'Satuan jumlah anak bawah 15 tahun',
                'jml_wanita_subur' => 'Jumlah wanita subur',
                'satuan_jml_wanita_subur' => 'Satuan jumlah wanita subur',
                'jml_ibu_hamil' => 'Jumlah ibu hamil',
                'satuan_jml_ibu_hamil' => 'Satuan jumlah ibu hamil',
                'jml_ibu_bersalin' => 'Jumlah ibu bersalin',
                'satuan_jml_ibu_bersalin' => 'Satuan jumlah ibu bersalin',
                'jml_desa' => 'Jumlah desa',
                'satuan_jml_desa' => 'Satuan jumlah desa'
            ]
        );

        $validatedData['user_id'] = Auth::id();
        $validatedData['slug'] = base64_encode(Str::random(8) . Carbon::now()->timestamp);

        $insert = PriorityTarget::create($validatedData);

        $riwayat = [
            'deskripsi' => 'User menambahkan Template Prioritas - Data Sasaran tahun ' . $request->tahun,
            'tipe_data' => 'prioritas_data_sasaran',
            'data_id' =>  $insert->id,
            'user_id' => Auth::id(),
            'ip_address' => $request->ip()
        ];

        DataHistory::create($riwayat);

        Alert::success('Sukses!', 'Berhasil menambahkan Template Prioritas - Data Sasaran. Silahkan periksa kembali Template Prioritas - Data Sasaran sebelum dilakukan pengajuan untuk diverifikasi.');
        return redirect()
            ->route('dashboard.priority.target.show', $insert->slug);
    }

    public function target_edit(PriorityTarget $priority_target)
    {
        if ((Auth::user()->role_name == 'Puskesmas' && $priority_target->user_id != Auth::id()) || (Auth::user()->role_name != 'Puskesmas' && $priority_target->status_verifikasi == 0))
            return redirect()->route('dashboard.priority.target');

        if ($priority_target->status_verifikasi == 0 || $priority_target->status_verifikasi == 3)
            return view('backend.pages.priority.target.edit', [
                'data' => $priority_target,
                'att' => DataHelper::INPUT_SASARAN
            ]);

        Alert::info('Informasi!', 'Template Prioritas - Data Sasaran tidak dapat diubah. ' . DataHelper::verification_message($priority_target->status_verifikasi));
        return redirect()
            ->route('dashboard.priority.target');
    }

    public function target_update(Request $request, PriorityTarget $priority_target)
    {
        $riwayat_plus = '';
        if ($request->tahun != $priority_target->tahun) {
            $data_sasaran = PriorityTarget::where('user_id', Auth::id())
                ->where('tahun', $request->tahun)
                ->count();
            $riwayat_plus = ' menjadi tahun ' . $request->tahun;

            if ($data_sasaran > 0) {
                Alert::info('Informasi!', 'Tahun tersebut telah ada sebelumnya. Silahkan periksa list Template Prioritas - Data Sasaran atau masukkan kembali tahun yang baru.');
                return redirect()
                    ->route('dashboard.priority.target.edit', $priority_target->slug)
                    ->withInput();
            }
        }

        $validatedData = $request->validate(
            [
                'tahun' => 'required|numeric',
                'jml_penduduk' => 'required|numeric',
                'satuan_jml_penduduk' => 'required',
                'jml_bayi_lahir_hidup' => 'required|numeric',
                'satuan_jml_bayi_lahir_hidup' => 'required',
                'jml_bayi' => 'required|numeric',
                'satuan_jml_bayi' => 'required',
                'jml_balita' => 'required|numeric',
                'satuan_jml_balita' => 'required',
                'jml_anak_sd_1' => 'required|numeric',
                'satuan_jml_anak_sd_1' => 'required',
                'jml_anak_sd_2_3' => 'required|numeric',
                'satuan_jml_anak_sd_2_3' => 'required',
                'jml_anak_b_15_th' => 'required|numeric',
                'satuan_jml_anak_b_15_th' => 'required',
                'jml_wanita_subur' => 'required|numeric',
                'satuan_jml_wanita_subur' => 'required',
                'jml_ibu_hamil' => 'required|numeric',
                'satuan_jml_ibu_hamil' => 'required',
                'jml_ibu_bersalin' => 'required|numeric',
                'satuan_jml_ibu_bersalin' => 'required',
                'jml_desa' => 'required|numeric',
                'satuan_jml_desa' => 'required'
            ],
            [],
            [
                'jml_penduduk' => 'Jumlah penduduk',
                'satuan_jml_penduduk' => 'Satuan jumlah penduduk',
                'jml_bayi_lahir_hidup' => 'Jumlah bayi lahir hidup',
                'satuan_jml_bayi_lahir_hidup' => 'Satuan jumlah bayi lahir hidup',
                'jml_bayi' => 'Jumlah bayi',
                'satuan_jml_bayi' => 'Satuan jumlah bayi',
                'jml_balita' => 'Jumlah balita',
                'satuan_jml_balita' => 'Satuan jumlah balita',
                'jml_anak_sd_1' => 'Jumlah anak SD kelas 1',
                'satuan_jml_anak_sd_1' => 'Satuan jumlah anak SD kelas 1',
                'jml_anak_sd_2_3' => 'Jumlah anak SD kelas 2 dan 3',
                'satuan_jml_anak_sd_2_3' => 'Satuan jumlah anak SD kelas 2 dan 3',
                'jml_anak_b_15_th' => 'Jumlah anak bawah 15 tahun',
                'satuan_jml_anak_b_15_th' => 'Satuan jumlah anak bawah 15 tahun',
                'jml_wanita_subur' => 'Jumlah wanita subur',
                'satuan_jml_wanita_subur' => 'Satuan jumlah wanita subur',
                'jml_ibu_hamil' => 'Jumlah ibu hamil',
                'satuan_jml_ibu_hamil' => 'Satuan jumlah ibu hamil',
                'jml_ibu_bersalin' => 'Jumlah ibu bersalin',
                'satuan_jml_ibu_bersalin' => 'Satuan jumlah ibu bersalin',
                'jml_desa' => 'Jumlah desa',
                'satuan_jml_desa' => 'Satuan jumlah desa'
            ]
        );

        $validatedData['waktu_perubahan'] = Carbon::now();
        $validatedData['waktu_verifikasi'] = null;
        $validatedData['status_verifikasi'] = 1;

        $priority_target->update($validatedData);

        $riwayat = [
            'deskripsi' => 'User mengubah Template Prioritas - Data Sasaran tahun ' . $priority_target->tahun . $riwayat_plus,
            'tipe_data' => 'prioritas_data_sasaran',
            'data_id' =>  $priority_target->id,
            'user_id' => Auth::id(),
            'ip_address' => $request->ip()
        ];

        DataHistory::create($riwayat);

        Alert::success('Sukses!', 'Berhasil mengubah Template Prioritas - Data Sasaran.');
        return redirect()
            ->route('dashboard.priority.target.show', $priority_target->slug);
    }

    public function target_submission(Request $request, PriorityTarget $priority_target)
    {
        if ($priority_target->status_verifikasi == 0) {
            $update_data = [
                'status_verifikasi' => 1,
                'waktu_pengajuan' => Carbon::now()
            ];
            $riwayat_dari = "Draft";
            $riwayat_jadi = "Pengajuan";
            $msg = 'Template Prioritas - Data Sasaran berhasil diajukan. Silahkan tunggu pemberitahuan verifikasi data.';
        } elseif ($priority_target->status_verifikasi == 1) {
            $update_data = [
                'status_verifikasi' => 0,
                'waktu_pengajuan' => null
            ];
            $riwayat_dari = "Pengajuan";
            $riwayat_jadi = "Draft";
            $msg = 'Pembatalan pengajuan Template Prioritas - Data Sasaran berhasil.';
        } else if ($priority_target->status_verifikasi == 3) {
            $update_data = [
                'status_verifikasi' => 1,
                'waktu_pengajuan' => Carbon::now()
            ];
            $riwayat_dari = "Diverifikasi";
            $riwayat_jadi = "Pengajuan";
            $msg = 'Template Prioritas - Data Sasaran berhasil diajukan kembali. Silahkan tunggu pemberitahuan verifikasi data.';
        }

        $riwayat = [
            'deskripsi' => 'User mengubah pengajuan Template Prioritas - Data Sasaran tahun ' . $priority_target->tahun . ' dari ' . $riwayat_dari . ' menjadi ' . $riwayat_jadi,
            'tipe_data' => 'prioritas_data_sasaran',
            'data_id' =>  $priority_target->id,
            'user_id' => Auth::id(),
            'ip_address' => $request->ip()
        ];

        $priority_target->update($update_data);


        DataHistory::create($riwayat);
        Alert::success('Sukses!', $msg);
        return redirect()
            ->route('dashboard.priority.target.show', $priority_target->slug);
    }

    public function target_destroy(Request $request)
    {
        $slug = $request->v;
        $data = PriorityTarget::where('user_id', Auth::id())
            ->where('slug', $slug);

        if ($data->count() == 0) {
            Alert::warning('Perhatian!', 'Data tidak sesuai dengan permintaan.');
            return redirect()
                ->route('dashboard.priority.target');
        } else {
            $data = $data->first();
            if ($data->status_verifikasi == 0) {
                $riwayat = [
                    'deskripsi' => 'User menghapus pengajuan Template Prioritas - Data Sasaran tahun ' . $data->tahun,
                    'tipe_data' => 'prioritas_data_sasaran',
                    'data_id' =>  $data->id,
                    'user_id' => Auth::id(),
                    'ip_address' => $request->ip()
                ];

                $data->delete();

                DataHistory::create($riwayat);

                Alert::success('Sukses!', 'Template Prioritas - Data Sasaran berhasil dihapus.');
                return redirect()
                    ->route('dashboard.priority.target');
            } else {
                Alert::info('Informasi!', 'Template Prioritas - Data Sasaran tidak dapat dihapus. ' . DataHelper::verification_message($data->status_verifikasi));
                return redirect()
                    ->route('dashboard.priority.target');
            }
        }
    }

    public function target_approval(Request $request, PriorityTarget $priority_target)
    {
        $verif_stat = $request->stat;

        if ($verif_stat == 2)
            $riwayat_desk = 'Administrator melakukan verifikasi data.';
        else if ($verif_stat == 3)
            $riwayat_desk = 'Administrator melakukan penolakan data.';
        else
            $riwayat_desk = 'Administrator melakukan penarikan verifikasi.';

        $update_data = [
            'verifikator_id' => Auth::id(),
            'waktu_verifikasi' => Carbon::now(),
            'status_verifikasi' => $verif_stat
        ];

        $priority_target->update($update_data);

        DataHistory::create([
            'deskripsi' => $riwayat_desk,
            'tipe_data' => 'prioritas_data_sasaran',
            'data_id' =>  $priority_target->id,
            'user_id' => Auth::id(),
            'ip_address' => $request->ip()
        ]);

        if ($verif_stat == 1)
            Alert::success('Sukses!', 'Berhasil melakukan penarikan verifikasi.');
        elseif ($verif_stat == 2)
            Alert::success('Sukses!', 'Berhasil melakukan verifikasi data.');
        else
            Alert::success('Sukses!', 'Berhasil melakukan penolakan data.');

        return redirect()
            ->route('dashboard.priority.target.show', $priority_target->slug);
    }

    // **                      **
    // *    END DATA SASARAN    *
    // **                      **

    // **                   **
    // *    DATA BULANAN     *
    // **                   **
    public function monthly(Request $request)
    {
        $filter = $request->filter;
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        if ($filter == 'semua_data' || !$filter)
            $where = [
                ['status_verifikasi', '!=', null]
            ];
        else if ($filter == 'draft')
            $where = [
                ['status_verifikasi', '=', 0]
            ];
        else if ($filter == 'proses_pemeriksaan')
            $where = [
                ['status_verifikasi', '=', 1]
            ];
        else if ($filter == 'verifikasi')
            $where = [
                ['status_verifikasi', '=', 2]
            ];
        else if ($filter == 'periksa_ulang')
            $where = [
                ['status_verifikasi', '=', 3]
            ];
        else
            return redirect()
                ->route('dashboard.priority.monthly');

        if ($tahun == 'semua_data' || !$tahun)
            array_push($where, ['tahun', '!=', null]);
        else
            array_push($where, ['tahun', '=', $tahun]);

        if ($bulan == 'semua_data' || !$bulan)
            array_push($where, ['bulan', '!=', null]);
        else
            array_push($where, ['bulan', '=', $bulan]);

        if (Auth::user()->role_name == 'Puskesmas')
            array_push($where, ['user_id', Auth::id()]);
        else
            array_push($where, ['status_verifikasi', '!=', 0]);

        $data = PriorityMonthly::where($where)
            ->orderBy('status_verifikasi', 'asc')
            ->orderBy('waktu_pengajuan', 'asc')
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->paginate(config('app.pagination_length'))->withQueryString();

        return view('backend.pages.priority.monthly.index', [
            'data' => $data,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'filter' => $filter
        ]);
    }

    public function monthly_show(PriorityMonthly $priority_monthly)
    {
        if ((Auth::user()->role_name == 'Puskesmas' && $priority_monthly->user_id != Auth::id()) || (Auth::user()->role_name != 'Puskesmas' && $priority_monthly->status_verifikasi == 0))
            return redirect()->route('dashboard.priority.monthly');

        $riwayat = DataHistory::where('tipe_data', 'prioritas_data_bulanan')
            ->where('data_id', $priority_monthly->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('backend.pages.priority.monthly.show', [
            'data' => $priority_monthly,
            'atts_1' => DataHelper::BULANAN_1,
            'atts_2' => DataHelper::BULANAN_2,
            'atts_3' => DataHelper::BULANAN_3,
            'atts_4' => DataHelper::BULANAN_4,
            'label' => DataHelper::LABEL_BULANAN,
            'riwayat' => $riwayat
        ]);
    }

    public function monthly_create()
    {
        return view('backend.pages.priority.monthly.create', [
            'atts_1' => DataHelper::BULANAN_1,
            'atts_2' => DataHelper::BULANAN_2,
            'atts_3' => DataHelper::BULANAN_3,
            'atts_4' => DataHelper::BULANAN_4,
            'label' => DataHelper::LABEL_BULANAN
        ]);
    }

    public function monthly_store(Request $request)
    {
        $data_bulanan = PriorityMonthly::where('user_id', Auth::id())
            ->where('bulan', $request->bulan)
            ->where('tahun', $request->tahun)
            ->count();

        if ($data_bulanan > 0) {
            Alert::info('Informasi!', 'Bulan dan tahun tersebut telah ada sebelumnya. Silahkan periksa list Template Prioritas - Data Bulanan atau masukkan kembali bulan dan tahun yang baru.');
            return redirect()
                ->route('dashboard.priority.monthly.create')
                ->withInput();
        }

        $validatedData = $request->validate(
            [
                'bulan' => 'required',
                'tahun' => 'required|numeric',
                'jml_k1' => 'required|numeric',
                'jml_k4' => 'required|numeric',
                'jml_pn' => 'required|numeric',
                'jml_ps' => 'required|numeric',
                'jml_kf' => 'required|numeric',
                'jml_kn1' => 'required|numeric',
                'jml_kn_lengkap' => 'required|numeric',
                'jml_bayi_lahir_hidup' => 'required|numeric',
                'jml_balita_ditimbang' => 'required|numeric',
                'jml_balita_gb_perawatan' => 'required|numeric',
                'jml_balita_gb_ditemukan' => 'required|numeric',
                'jml_imun_bcg' => 'required|numeric',
                'jml_imun_hepatitis_b' => 'required|numeric',
                'jml_imun_dpt_1' => 'required|numeric',
                'jml_imun_dpt_2' => 'required|numeric',
                'jml_imun_dpt_3' => 'required|numeric',
                'jml_imun_folio_1' => 'required|numeric',
                'jml_imun_folio_2' => 'required|numeric',
                'jml_imun_folio_3' => 'required|numeric',
                'jml_imun_folio_4' => 'required|numeric',
                'jml_imun_campak' => 'required|numeric',
                'jml_imun_dasar_lengkap' => 'required|numeric',
                'jml_pneumonia' => 'required|numeric',
                'jml_diare' => 'required|numeric',
                'jml_afp' => 'required|numeric',
                'jml_malaria_konfirmasi' => 'required|numeric',
                'jml_malaria_positif' => 'required|numeric',
                'jml_malaria_pengobatan' => 'required|numeric',
                'jml_dbd' => 'required|numeric',
                'jml_kematian_dbd' => 'required|numeric',
                'jml_klb' => 'required|numeric',
                'satuan_jml_k1' => 'required',
                'satuan_jml_k4' => 'required',
                'satuan_jml_pn' => 'required',
                'satuan_jml_ps' => 'required',
                'satuan_jml_kf' => 'required',
                'satuan_jml_kn1' => 'required',
                'satuan_jml_kn_lengkap' => 'required',
                'satuan_jml_bayi_lahir_hidup' => 'required',
                'satuan_jml_balita_ditimbang' => 'required',
                'satuan_jml_balita_gb_perawatan' => 'required',
                'satuan_jml_balita_gb_ditemukan' => 'required',
                'satuan_jml_imun_bcg' => 'required',
                'satuan_jml_imun_hepatitis_b' => 'required',
                'satuan_jml_imun_dpt_1' => 'required',
                'satuan_jml_imun_dpt_2' => 'required',
                'satuan_jml_imun_dpt_3' => 'required',
                'satuan_jml_imun_folio_1' => 'required',
                'satuan_jml_imun_folio_2' => 'required',
                'satuan_jml_imun_folio_3' => 'required',
                'satuan_jml_imun_folio_4' => 'required',
                'satuan_jml_imun_campak' => 'required',
                'satuan_jml_imun_dasar_lengkap' => 'required',
                'satuan_jml_pneumonia' => 'required',
                'satuan_jml_diare' => 'required',
                'satuan_jml_afp' => 'required',
                'satuan_jml_malaria_konfirmasi' => 'required',
                'satuan_jml_malaria_positif' => 'required',
                'satuan_jml_malaria_pengobatan' => 'required',
                'satuan_jml_dbd' => 'required',
                'satuan_jml_kematian_dbd' => 'required',
                'satuan_jml_klb' => 'required',
            ]
        );

        $validatedData['user_id'] = Auth::id();
        $validatedData['slug'] = base64_encode(Str::random(8) . Carbon::now()->timestamp);

        $insert = PriorityMonthly::create($validatedData);

        $riwayat = [
            'deskripsi' => 'User menambahkan Template Prioritas - Data Bulanan bulan ' . $request->bulan . ' tahun ' . $request->tahun,
            'tipe_data' => 'prioritas_data_bulanan',
            'data_id' =>  $insert->id,
            'user_id' => Auth::id(),
            'ip_address' => $request->ip()
        ];

        DataHistory::create($riwayat);

        Alert::success('Sukses!', 'Berhasil menambahkan Template Prioritas - Data Bulanan. Silahkan periksa kembali Template Prioritas - Data Bulanan sebelum dilakukan pengajuan untuk diverifikasi.');
        return redirect()
            ->route('dashboard.priority.monthly.show', $insert->slug);
    }

    public function monthly_edit(PriorityMonthly $priority_monthly)
    {
        if ((Auth::user()->role_name == 'Puskesmas' && $priority_monthly->user_id != Auth::id()) || (Auth::user()->role_name != 'Puskesmas' && $priority_monthly->status_verifikasi == 0))
            return redirect()->route('dashboard.priority.monthly');

        if ($priority_monthly->status_verifikasi == 0 || $priority_monthly->status_verifikasi == 3)
            return view('backend.pages.priority.monthly.edit', [
                'data' => $priority_monthly,
                'atts_1' => DataHelper::BULANAN_1,
                'atts_2' => DataHelper::BULANAN_2,
                'atts_3' => DataHelper::BULANAN_3,
                'atts_4' => DataHelper::BULANAN_4,
                'label' => DataHelper::LABEL_BULANAN
            ]);

        Alert::info('Informasi!', 'Template Prioritas - Data Bulanan tidak dapat diubah. ' . DataHelper::verification_message($priority_monthly->status_verifikasi));
        return redirect()
            ->route('dashboard.priority.monthly');
    }

    public function monthly_update(Request $request, PriorityMonthly $priority_monthly)
    {
        $riwayat_plus = '';

        if ($priority_monthly->bulan != $request->bulan || $priority_monthly->tahun != $request->tahun) {
            $data_tahunan = PriorityMonthly::where('user_id', Auth::id())
                ->where('bulan', $request->bulan)
                ->where('tahun', $request->tahun)
                ->count();
            $riwayat_plus = ' menjadi bulan ' . $request->bulan . ' tahun ' . $request->tahun;

            if ($data_tahunan > 0) {
                Alert::info('Informasi!', 'Bulan dan tahun tersebut telah ada sebelumnya. Silahkan periksa list data tahunan atau masukkan kembali bulan dan tahun yang baru.');
                return redirect()
                    ->route('dashboard.priority.monthly.edit', $priority_monthly->slug)
                    ->withInput();
            }
        }

        $validatedData = $request->validate(
            [
                'bulan' => 'required',
                'tahun' => 'required|numeric',
                'jml_k1' => 'required|numeric',
                'jml_k4' => 'required|numeric',
                'jml_pn' => 'required|numeric',
                'jml_ps' => 'required|numeric',
                'jml_kf' => 'required|numeric',
                'jml_kn1' => 'required|numeric',
                'jml_kn_lengkap' => 'required|numeric',
                'jml_bayi_lahir_hidup' => 'required|numeric',
                'jml_balita_ditimbang' => 'required|numeric',
                'jml_balita_gb_perawatan' => 'required|numeric',
                'jml_balita_gb_ditemukan' => 'required|numeric',
                'jml_imun_bcg' => 'required|numeric',
                'jml_imun_hepatitis_b' => 'required|numeric',
                'jml_imun_dpt_1' => 'required|numeric',
                'jml_imun_dpt_2' => 'required|numeric',
                'jml_imun_dpt_3' => 'required|numeric',
                'jml_imun_folio_1' => 'required|numeric',
                'jml_imun_folio_2' => 'required|numeric',
                'jml_imun_folio_3' => 'required|numeric',
                'jml_imun_folio_4' => 'required|numeric',
                'jml_imun_campak' => 'required|numeric',
                'jml_imun_dasar_lengkap' => 'required|numeric',
                'jml_pneumonia' => 'required|numeric',
                'jml_diare' => 'required|numeric',
                'jml_afp' => 'required|numeric',
                'jml_malaria_konfirmasi' => 'required|numeric',
                'jml_malaria_positif' => 'required|numeric',
                'jml_malaria_pengobatan' => 'required|numeric',
                'jml_dbd' => 'required|numeric',
                'jml_kematian_dbd' => 'required|numeric',
                'jml_klb' => 'required|numeric',
                'satuan_jml_k1' => 'required',
                'satuan_jml_k4' => 'required',
                'satuan_jml_pn' => 'required',
                'satuan_jml_ps' => 'required',
                'satuan_jml_kf' => 'required',
                'satuan_jml_kn1' => 'required',
                'satuan_jml_kn_lengkap' => 'required',
                'satuan_jml_bayi_lahir_hidup' => 'required',
                'satuan_jml_balita_ditimbang' => 'required',
                'satuan_jml_balita_gb_perawatan' => 'required',
                'satuan_jml_balita_gb_ditemukan' => 'required',
                'satuan_jml_imun_bcg' => 'required',
                'satuan_jml_imun_hepatitis_b' => 'required',
                'satuan_jml_imun_dpt_1' => 'required',
                'satuan_jml_imun_dpt_2' => 'required',
                'satuan_jml_imun_dpt_3' => 'required',
                'satuan_jml_imun_folio_1' => 'required',
                'satuan_jml_imun_folio_2' => 'required',
                'satuan_jml_imun_folio_3' => 'required',
                'satuan_jml_imun_folio_4' => 'required',
                'satuan_jml_imun_campak' => 'required',
                'satuan_jml_imun_dasar_lengkap' => 'required',
                'satuan_jml_pneumonia' => 'required',
                'satuan_jml_diare' => 'required',
                'satuan_jml_afp' => 'required',
                'satuan_jml_malaria_konfirmasi' => 'required',
                'satuan_jml_malaria_positif' => 'required',
                'satuan_jml_malaria_pengobatan' => 'required',
                'satuan_jml_dbd' => 'required',
                'satuan_jml_kematian_dbd' => 'required',
                'satuan_jml_klb' => 'required',
            ]
        );

        $validatedData['waktu_perubahan'] = Carbon::now();
        $validatedData['waktu_verifikasi'] = null;

        $riwayat = [
            'deskripsi' => 'User mengubah Template Prioritas - Data Bulanan bulan ' . $priority_monthly->bulan . ' tahun ' . $priority_monthly->tahun . $riwayat_plus,
            'tipe_data' => 'prioritas_data_bulanan',
            'data_id' =>  $priority_monthly->id,
            'user_id' => Auth::id(),
            'ip_address' => $request->ip()
        ];

        $priority_monthly->update($validatedData);

        DataHistory::create($riwayat);

        Alert::success('Sukses!', 'Berhasil mengubah Template Prioritas - Data Bulanan.');
        return redirect()
            ->route('dashboard.priority.monthly.show', $priority_monthly->slug);
    }

    public function monthly_submission(Request $request, PriorityMonthly $priority_monthly)
    {
        if ($priority_monthly->status_verifikasi == 0) {
            $update_data = [
                'status_verifikasi' => 1,
                'waktu_pengajuan' => Carbon::now()
            ];
            $msg = 'Template Prioritas - Data Bulanan berhasil diajukan. Silahkan tunggu pemberitahuan verifikasi data.';
            $riwayat_dari = "Draft";
            $riwayat_jadi = "Pengajuan";
        } elseif ($priority_monthly->status_verifikasi == 1) {
            $update_data = [
                'status_verifikasi' => 0,
                'waktu_pengajuan' => null
            ];
            $msg = 'Pembatalan pengajuan Template Prioritas - Data Bulanan berhasil.';
            $riwayat_dari = "Pengajuan";
            $riwayat_jadi = "Draft";
        } else if ($priority_monthly->status_verifikasi == 3) {
            $update_data = [
                'status_verifikasi' => 1,
                'waktu_pengajuan' => Carbon::now()
            ];
            $msg = 'Template Prioritas - Data Bulanan berhasil diajukan kembali. Silahkan tunggu pemberitahuan verifikasi data.';
            $riwayat_dari = "Diverifikasi";
            $riwayat_jadi = "Pengajuan";
        }
        $priority_monthly->update($update_data);

        $riwayat = [
            'deskripsi' => 'User mengubah pengajuan Template Prioritas - Data Bulanan bulan ' . $priority_monthly->bulan . ' tahun ' . $priority_monthly->tahun . ' dari ' . $riwayat_dari . ' menjadi ' . $riwayat_jadi,
            'tipe_data' => 'prioritas_data_bulanan',
            'data_id' =>  $priority_monthly->id,
            'user_id' => Auth::id(),
            'ip_address' => $request->ip()
        ];

        DataHistory::create($riwayat);
        Alert::success('Sukses!', $msg);
        return redirect()
            ->route('dashboard.priority.monthly.show', $priority_monthly->slug);
    }

    public function monthly_destroy(Request $request)
    {
        $slug = $request->v;
        $data = PriorityMonthly::where('user_id', Auth::id())
            ->where('slug', $slug);

        if ($data->count() == 0) {
            Alert::warning('Perhatian!', 'Data tidak sesuai dengan permintaan.');
            return redirect()
                ->route('dashboard.priority.monthly');
        } else {
            $data = $data->first();
            if ($data->status_verifikasi == 0) {
                $riwayat = [
                    'deskripsi' => 'User menghapus pengajuan Template Prioritas - Data Bulanan bulan ' . $data->bulan . ' tahun ' . $data->tahun,
                    'tipe_data' => 'prioritas_data_bulanan',
                    'data_id' =>  $data->id,
                    'user_id' => Auth::id(),
                    'ip_address' => $request->ip()
                ];

                $data->delete();

                DataHistory::create($riwayat);

                Alert::success('Sukses!', 'Template Prioritas - Data Bulanan berhasil dihapus.');
                return redirect()
                    ->route('dashboard.priority.monthly');
            } else {
                Alert::info('Informasi!', 'Template Prioritas - Data Bulanan tidak dapat dihapus. ' . DataHelper::verification_message($data->status_verifikasi));
                return redirect()
                    ->route('dashboard.priority.monthly');
            }
        }
    }

    public function monthly_approval(Request $request, PriorityMonthly $priority_monthly)
    {
        $verif_stat = $request->stat;

        if ($verif_stat == 2)
            $riwayat_desk = 'Administrator melakukan verifikasi data.';
        else if ($verif_stat == 3)
            $riwayat_desk = 'Administrator melakukan penolakan data.';
        else
            $riwayat_desk = 'Administrator melakukan penarikan verifikasi.';

        $update_data = [
            'verifikator_id' => Auth::id(),
            'waktu_verifikasi' => Carbon::now(),
            'status_verifikasi' => $verif_stat
        ];

        $priority_monthly->update($update_data);

        DataHistory::create([
            'deskripsi' => $riwayat_desk,
            'tipe_data' => 'prioritas_data_bulanan',
            'data_id' =>  $priority_monthly->id,
            'user_id' => Auth::id(),
            'ip_address' => $request->ip()
        ]);

        if ($verif_stat == 1)
            Alert::success('Sukses!', 'Berhasil melakukan penarikan verifikasi.');
        elseif ($verif_stat == 2)
            Alert::success('Sukses!', 'Berhasil melakukan verifikasi data.');
        else
            Alert::success('Sukses!', 'Berhasil melakukan penolakan data.');

        return redirect()
            ->route('dashboard.priority.monthly.show', $priority_monthly->slug);
    }
    // **                      **
    // *    END DATA BULANAN    *
    // **                      **

    // **                  **
    // *    DATA TAHUNAN    *
    // **                  **
    public function yearly(Request $request)
    {
        $filter = $request->filter;
        $tahun = $request->tahun;

        if ($filter == 'semua_data' || !$filter)
            $where = [
                ['status_verifikasi', '!=', null]
            ];
        else if ($filter == 'draft')
            $where = [
                ['status_verifikasi', '=', 0]
            ];
        else if ($filter == 'proses_pemeriksaan')
            $where = [
                ['status_verifikasi', '=', 1]
            ];
        else if ($filter == 'verifikasi')
            $where = [
                ['status_verifikasi', '=', 2]
            ];
        else if ($filter == 'periksa_ulang')
            $where = [
                ['status_verifikasi', '=', 3]
            ];
        else
            return redirect()
                ->route('dashboard.priority.yearly');

        if ($tahun == 'semua_data' || !$tahun)
            array_push($where, ['tahun', '!=', null]);
        else
            array_push($where, ['tahun', '=', $tahun]);

        if (Auth::user()->role_name == 'Puskesmas')
            array_push($where, ['user_id', Auth::id()]);
        else
            array_push($where, ['status_verifikasi', '!=', 0]);

        $data = PriorityYearly::where($where)
            ->orderBy('tahun', 'desc')
            ->paginate(config('app.pagination_length'))->withQueryString();

        return view('backend.pages.priority.yearly.index', [
            'data' => $data,
            'tahun' => $tahun,
            'filter' => $filter
        ]);
    }

    public function yearly_show(PriorityYearly $priority_yearly)
    {
        if ((Auth::user()->role_name == 'Puskesmas' && $priority_yearly->user_id != Auth::id()) || (Auth::user()->role_name != 'Puskesmas' && $priority_yearly->status_verifikasi == 0))
            return redirect()->route('dashboard.priority.yearly');

        $riwayat = DataHistory::where('tipe_data', 'prioritas_data_tahunan')
            ->where('data_id', $priority_yearly->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('backend.pages.priority.yearly.show', [
            'data' => $priority_yearly,
            'atts_1' => DataHelper::TAHUNAN_1,
            'atts_2' => DataHelper::TAHUNAN_2,
            'label' => DataHelper::LABEL_TAHUNAN,
            'riwayat' => $riwayat
        ]);
    }

    public function yearly_create()
    {
        return view('backend.pages.priority.yearly.create', [
            'atts_1' => DataHelper::TAHUNAN_1,
            'atts_2' => DataHelper::TAHUNAN_2,
            'label' => DataHelper::LABEL_TAHUNAN
        ]);
    }

    public function yearly_store(Request $request)
    {
        $data_tahunan = PriorityYearly::where('user_id', Auth::id())
            ->where('tahun', $request->tahun)
            ->count();

        if ($data_tahunan > 0) {
            Alert::info('Informasi!', 'Tahun tersebut telah ada sebelumnya. Silahkan periksa list Template Prioritas - Data Tahunan atau masukkan kembali tahun yang baru.');
            return redirect()
                ->route('dashboard.priority.yearly.create')
                ->withInput();
        }

        $validatedData = $request->validate(
            [
                'tahun' => 'required|numeric',
                'jml_kusta_pb_anak' => 'required|numeric',
                'jml_kusta_pb_dewasa' => 'required|numeric',
                'jml_kusta_mb_anak' => 'required|numeric',
                'jml_kusta_mb_dewasa' => 'required|numeric',
                'jml_cacat_tk_2' => 'required|numeric',
                'jml_filariasis' => 'required|numeric',
                'jml_obat_cacing' => 'required|numeric',
                'jml_posyandu' => 'required|numeric',
                'jml_desa_siaga' => 'required|numeric',
                'jml_rt_phbs' => 'required|numeric',
                'satuan_jml_kusta_pb_anak' => 'required',
                'satuan_jml_kusta_pb_dewasa' => 'required',
                'satuan_jml_kusta_mb_anak' => 'required',
                'satuan_jml_kusta_mb_dewasa' => 'required',
                'satuan_jml_cacat_tk_2' => 'required',
                'satuan_jml_filariasis' => 'required',
                'satuan_jml_obat_cacing' => 'required',
                'satuan_jml_posyandu' => 'required',
                'satuan_jml_desa_siaga' => 'required',
                'satuan_jml_rt_phbs' => 'required',
            ]
        );

        $validatedData['user_id'] = Auth::id();
        $validatedData['slug'] = base64_encode(Str::random(8) . Carbon::now()->timestamp);

        $insert = PriorityYearly::create($validatedData);

        $riwayat = [
            'deskripsi' => 'User menambahkan Template Prioritas - Data Tahunan tahun ' . $request->tahun,
            'tipe_data' => 'prioritas_data_tahunan',
            'data_id' =>  $insert->id,
            'user_id' => Auth::id(),
            'ip_address' => $request->ip()
        ];

        DataHistory::create($riwayat);

        Alert::success('Sukses!', 'Berhasil menambahkan Template Prioritas - Data Tahunan. Silahkan periksa kembali Template Prioritas - Data Tahunan sebelum dilakukan pengajuan untuk diverifikasi.');
        return redirect()
            ->route('dashboard.priority.yearly.show', $insert->slug);
    }

    public function yearly_edit(PriorityYearly $priority_yearly)
    {
        if ((Auth::user()->role_name == 'Puskesmas' && $priority_yearly->user_id != Auth::id()) || (Auth::user()->role_name != 'Puskesmas' && $priority_yearly->status_verifikasi == 0))
            return redirect()->route('dashboard.priority.monthly');

        if ($priority_yearly->status_verifikasi == 0 || $priority_yearly->status_verifikasi == 3)
            return view('backend.pages.priority.yearly.edit', [
                'data' => $priority_yearly,
                'atts_1' => DataHelper::TAHUNAN_1,
                'atts_2' => DataHelper::TAHUNAN_2,
                'label' => DataHelper::LABEL_TAHUNAN
            ]);

        Alert::info('Informasi!', 'Template Prioritas - Data Tahunan tidak dapat diubah. ' . DataHelper::verification_message($priority_yearly->status_verifikasi));
        return redirect()
            ->route('dashboard.priority.yearly');
    }

    public function yearly_update(Request $request, PriorityYearly $priority_yearly)
    {
        $riwayat_plus = '';

        if ($priority_yearly->tahun != $request->tahun) {
            $data_tahunan = PriorityYearly::where('user_id', Auth::id())
                ->where('tahun', $request->tahun)
                ->count();
            $riwayat_plus = ' menjadi tahun ' . $request->tahun;

            if ($data_tahunan > 0) {
                Alert::info('Informasi!', 'Tahun tersebut telah ada sebelumnya. Silahkan periksa list Template Prioritas - Data Tahunan atau masukkan kembali tahun yang baru.');
                return redirect()
                    ->route('dashboard.priority.yearly.edit', $priority_yearly->slug)
                    ->withInput();
            }
        }

        $validatedData = $request->validate(
            [
                'tahun' => 'required|numeric',
                'jml_kusta_pb_anak' => 'required|numeric',
                'jml_kusta_pb_dewasa' => 'required|numeric',
                'jml_kusta_mb_anak' => 'required|numeric',
                'jml_kusta_mb_dewasa' => 'required|numeric',
                'jml_cacat_tk_2' => 'required|numeric',
                'jml_filariasis' => 'required|numeric',
                'jml_obat_cacing' => 'required|numeric',
                'jml_posyandu' => 'required|numeric',
                'jml_desa_siaga' => 'required|numeric',
                'jml_rt_phbs' => 'required|numeric',
                'satuan_jml_kusta_pb_anak' => 'required',
                'satuan_jml_kusta_pb_dewasa' => 'required',
                'satuan_jml_kusta_mb_anak' => 'required',
                'satuan_jml_kusta_mb_dewasa' => 'required',
                'satuan_jml_cacat_tk_2' => 'required',
                'satuan_jml_filariasis' => 'required',
                'satuan_jml_obat_cacing' => 'required',
                'satuan_jml_posyandu' => 'required',
                'satuan_jml_desa_siaga' => 'required',
                'satuan_jml_rt_phbs' => 'required',
            ]
        );

        $validatedData['waktu_perubahan'] = Carbon::now();
        $validatedData['waktu_verifikasi'] = null;

        $riwayat = [
            'deskripsi' => 'User mengubah Template Prioritas - Data Tahunan tahun ' . $priority_yearly->tahun . $riwayat_plus,
            'tipe_data' => 'prioritas_data_tahunan',
            'data_id' =>  $priority_yearly->id,
            'user_id' => Auth::id(),
            'ip_address' => $request->ip()
        ];

        $priority_yearly->update($validatedData);

        DataHistory::create($riwayat);

        Alert::success('Sukses!', 'Berhasil mengubah Template Prioritas - Data Tahunan.');
        return redirect()
            ->route('dashboard.priority.yearly.show', $priority_yearly->slug);
    }

    public function yearly_submission(Request $request, PriorityYearly $priority_yearly)
    {
        if ($priority_yearly->status_verifikasi == 0) {
            $update_data = [
                'status_verifikasi' => 1,
                'waktu_pengajuan' => Carbon::now()
            ];
            $msg = 'Template Prioritas - Data Tahunan berhasil diajukan. Silahkan tunggu pemberitahuan verifikasi data.';
            $riwayat_dari = "Draft";
            $riwayat_jadi = "Pengajuan";
        } else if ($priority_yearly->status_verifikasi == 1) {
            $update_data = [
                'status_verifikasi' => 0,
                'waktu_pengajuan' => null
            ];
            $msg = 'Pembatalan pengajuan Template Prioritas - Data Tahunan berhasil.';
            $riwayat_dari = "Pengajuan";
            $riwayat_jadi = "Draft";
        } else if ($priority_yearly->status_verifikasi == 3) {
            $update_data = [
                'status_verifikasi' => 1,
                'waktu_pengajuan' => Carbon::now()
            ];
            $msg = 'Template Prioritas - Data Tahunan berhasil diajukan kembali. Silahkan tunggu pemberitahuan verifikasi data.';
            $riwayat_dari = "Diverifikasi";
            $riwayat_jadi = "Pengajuan";
        }

        $riwayat = [
            'deskripsi' => 'User mengubah pengajuan Template Prioritas - Data Tahunan tahun ' . $priority_yearly->tahun . ' dari ' . $riwayat_dari . ' menjadi ' . $riwayat_jadi,
            'tipe_data' => 'prioritas_data_tahunan',
            'data_id' =>  $priority_yearly->id,
            'user_id' => Auth::id(),
            'ip_address' => $request->ip()
        ];
        $priority_yearly->update($update_data);

        DataHistory::create($riwayat);
        Alert::success('Sukses!', $msg);
        return redirect()
            ->route('dashboard.priority.yearly.show', $priority_yearly->slug);
    }

    public function yearly_destroy(Request $request)
    {
        $slug = $request->v;
        $data = PriorityYearly::where('user_id', Auth::id())
            ->where('slug', $slug);

        if ($data->count() == 0) {
            Alert::warning('Perhatian!', 'Data tidak sesuai dengan permintaan.');
            return redirect()
                ->route('dashboard.priority.yearly');
        } else {
            $data = $data->first();
            if ($data->status_verifikasi == 0) {
                $riwayat = [
                    'deskripsi' => 'User menghapus pengajuan Template Prioritas - Data Tahunan tahun ' . $data->tahun,
                    'tipe_data' => 'prioritas_data_tahunan',
                    'data_id' =>  $data->id,
                    'user_id' => Auth::id(),
                    'ip_address' => $request->ip()
                ];

                $data->delete();

                DataHistory::create($riwayat);

                Alert::success('Sukses!', 'Template Prioritas - Data Tahunan berhasil dihapus.');
                return redirect()
                    ->route('dashboard.priority.yearly');
            } else {
                Alert::info('Informasi!', 'Template Prioritas - Data Tahunan tidak dapat dihapus. ' . DataHelper::verification_message($data->status_verifikasi));
                return redirect()
                    ->route('dashboard.priority.yearly');
            }
        }
    }

    public function yearly_approval(Request $request, PriorityYearly $priority_yearly)
    {
        $verif_stat = $request->stat;

        if ($verif_stat == 2)
            $riwayat_desk = 'Administrator melakukan verifikasi data.';
        else if ($verif_stat == 3)
            $riwayat_desk = 'Administrator melakukan penolakan data.';
        else
            $riwayat_desk = 'Administrator melakukan penarikan verifikasi.';

        $update_data = [
            'verifikator_id' => Auth::id(),
            'waktu_verifikasi' => Carbon::now(),
            'status_verifikasi' => $verif_stat
        ];

        $priority_yearly->update($update_data);

        DataHistory::create([
            'deskripsi' => $riwayat_desk,
            'tipe_data' => 'prioritas_data_tahunan',
            'data_id' =>  $priority_yearly->id,
            'user_id' => Auth::id(),
            'ip_address' => $request->ip()
        ]);

        if ($verif_stat == 1)
            Alert::success('Sukses!', 'Berhasil melakukan penarikan verifikasi.');
        elseif ($verif_stat == 2)
            Alert::success('Sukses!', 'Berhasil melakukan verifikasi data.');
        else
            Alert::success('Sukses!', 'Berhasil melakukan penolakan data.');

        return redirect()
            ->route('dashboard.priority.yearly.show', $priority_yearly->slug);
    }
    // **                      **
    // *    END DATA TAHUNAN    *
    // **                      **
}
