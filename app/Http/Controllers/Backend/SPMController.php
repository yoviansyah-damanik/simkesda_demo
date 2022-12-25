<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\SPMTarget;
use App\Models\SPMYearly;
use App\Helpers\DataHelper;
use App\Models\DataHistory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use \PDF;

class SPMController extends BackendController
{
    public function index()
    {
        $spm_sasaran = SPMTarget::get();
        $spm_tahunan = SPMYearly::get();

        if (Auth::user()->role_name == 'Puskesmas')
            $sasaran_count = $spm_sasaran->where('user_id', Auth::id())
                ->count();
        else
            $sasaran_count = $spm_sasaran->count();

        $sasaran_count = $sasaran_count > 0 ? $sasaran_count : 1;

        $sasaran_0 = $spm_sasaran->where('status_verifikasi', 0);
        if (Auth::user()->role_name == 'Puskesmas')
            $sasaran_0 = $sasaran_0->where('user_id', Auth::id());
        $sasaran_0 = $sasaran_0->count();

        $sasaran_1 = $spm_sasaran->where('status_verifikasi', 1);
        if (Auth::user()->role_name == 'Puskesmas')
            $sasaran_1 = $sasaran_1->where('user_id', Auth::id());
        $sasaran_1 = $sasaran_1->count();

        $sasaran_2 = $spm_sasaran->where('status_verifikasi', 2);
        if (Auth::user()->role_name == 'Puskesmas')
            $sasaran_2 = $sasaran_2->where('user_id', Auth::id());
        $sasaran_2 = $sasaran_2->count();

        $sasaran_3 = $spm_sasaran->where('status_verifikasi', 3);
        if (Auth::user()->role_name == 'Puskesmas')
            $sasaran_3 = $sasaran_3->where('user_id', Auth::id());
        $sasaran_3 = $sasaran_3->count();

        if (Auth::user()->role_name == 'Puskesmas')
            $tahunan_count = $spm_tahunan->where('user_id', Auth::id())
                ->count();
        else
            $tahunan_count = $spm_tahunan->count();

        $tahunan_count = $tahunan_count > 0 ? $tahunan_count : 1;

        $tahunan_0 = $spm_tahunan->where('status_verifikasi', 0);
        if (Auth::user()->role_name == 'Puskesmas')
            $tahunan_0 = $tahunan_0->where('user_id', Auth::id());
        $tahunan_0 = $tahunan_0->count();

        $tahunan_1 = $spm_tahunan->where('status_verifikasi', 1);
        if (Auth::user()->role_name == 'Puskesmas')
            $tahunan_1 = $tahunan_1->where('user_id', Auth::id());
        $tahunan_1 = $tahunan_1->count();

        $tahunan_2 = $spm_tahunan->where('status_verifikasi', 2);
        if (Auth::user()->role_name == 'Puskesmas')
            $tahunan_2 = $tahunan_2->where('user_id', Auth::id());
        $tahunan_2 = $tahunan_2->count();

        $tahunan_3 = $spm_tahunan->where('status_verifikasi', 3);
        if (Auth::user()->role_name == 'Puskesmas')
            $tahunan_3 = $tahunan_3->where('user_id', Auth::id());
        $tahunan_3 = $tahunan_3->count();

        $spm = [
            "spm_target" => [
                'label' => 'SPM - Data Sasaran',
                'items' => [
                    ['item' => $sasaran_1, 'type' => 1, 'link' => route('dashboard.spm.target', ['filter' => 'proses_pemeriksaan']), 'percentage' => ($sasaran_1 / $sasaran_count * 100)],
                    ['item' => $sasaran_2, 'type' => 2, 'link' => route('dashboard.spm.target', ['filter' => 'verifikasi']), 'percentage' => ($sasaran_2 / $sasaran_count * 100)],
                    ['item' => $sasaran_3, 'type' => 3, 'link' => route('dashboard.spm.target', ['filter' => 'periksa_ulang']), 'percentage' => ($sasaran_3 / $sasaran_count * 100)],
                ]
            ],
            "spm_yearly" => [
                'label' => 'SPM - Data Tahunan',
                'items' => [
                    ['item' => $tahunan_1, 'type' => 1, 'link' => route('dashboard.spm.yearly', ['filter' => 'proses_pemeriksaan']), 'percentage' => ($tahunan_1 / $tahunan_count * 100)],
                    ['item' => $tahunan_2, 'type' => 2, 'link' => route('dashboard.spm.yearly', ['filter' => 'verifikasi']), 'percentage' => ($tahunan_2 / $tahunan_count * 100)],
                    ['item' => $tahunan_3, 'type' => 3, 'link' => route('dashboard.spm.yearly', ['filter' => 'periksa_ulang']), 'percentage' => ($tahunan_3 / $tahunan_count * 100)],
                ]
            ],
        ];

        if (Auth::user()->role_name == 'Puskesmas') {
            array_unshift(
                $spm['spm_target']['items'],
                ['item' => $sasaran_0, 'type' => 0, 'link' => route('dashboard.spm.target', ['filter' => 'draft']), 'percentage' => ($sasaran_0 / $sasaran_count * 100)],
            );
            array_unshift(
                $spm['spm_yearly']['items'],
                ['item' => $tahunan_0, 'type' => 0, 'link' => route('dashboard.spm.yearly', ['filter' => 'draft']), 'percentage' => ($tahunan_0 / $sasaran_count * 100)],
            );
        }

        return view('backend.pages.spm.index', [
            'data' => $spm
        ]);
    }

    public function report()
    {
        if (Auth::user()->role_name == 'Puskesmas') {
            return view('backend.pages.spm.report.user');
        } else {
            $users = User::role('Puskesmas')
                ->get();

            return view('backend.pages.spm.report.admin', compact('users'));
        }
    }

    public function download_user(Request $request)
    {
        $spm = $request->spm;
        $tahun = $request->tahun;

        if ($spm == 'data_sasaran') {
            $data = SPMTarget::where('user_id', Auth::id())
                ->where('status_verifikasi', 2)
                ->where('tahun', $tahun);

            if ($data->count() == 0) {
                Alert::warning('Perhatian!', 'Data SPM - Data Sasaran pada tahun tersebut tidak ditemukan.');
                return redirect()
                    ->route('dashboard.spm.report')
                    ->withInput();
            } else {
                $data = $data->first();
            }

            if ($tahun == 'semua_tahun')
                $tahun = 'Semua Tahun';

            $pdf = PDF::loadview('backend.pages.report.user.cetak_spm_sasaran', [
                'data' => $data,
                'agent' => $this->agent,
                'tahun' => $tahun,
                'att' => DataHelper::SPM_BULANAN,
            ]);

            return $pdf->download(Auth::user()->name . "_Laporan SPM_SPM Sasaran_Tahun ${tahun}.pdf");
        } else if ($spm == 'data_tahunan') {
            $data = SPMYearly::where('user_id', Auth::id())
                ->where('status_verifikasi', 2)
                ->where('tahun', $tahun);

            if ($data->count() == 0) {
                Alert::warning('Perhatian!', 'Data SPM - Data Tahunan pada tahun tersebut tidak ditemukan.');
                return redirect()
                    ->route('dashboard.spm.report')
                    ->withInput();
            } else {
                $data = $data->first();
            }

            $pdf = PDF::loadview('backend.pages.report.user.cetak_spm_tahunan', [
                'data' => $data,
                'agent' => $this->agent,
                'tahun' => $tahun,
                'att' => DataHelper::SPM_TAHUNAN,
            ]);
            return $pdf->download(Auth::user()->name . "_Laporan SPM_SPM Tahunan_Tahun ${tahun}.pdf");
        }
    }

    public function download_admin(Request $request)
    {
        $spm = $request->spm;
        $tahun = $request->tahun;
        $user = $request->user;

        if ($spm == 'data_sasaran') {
            if ($user == 'semua_puskesmas') {
                $data = SPMTarget::where('status_verifikasi', 2)
                    ->where('tahun', $tahun);

                if ($data->count() == 0) {
                    Alert::warning('Perhatian!', 'Data SPM - Data Sasaran pada tahun tersebut tidak ditemukan.');
                    return redirect()
                        ->route('dashboard.spm.report')
                        ->withInput();
                } else {
                    $data = $data->get();
                }

                if ($tahun == 'semua_tahun')
                    $tahun = 'Semua Tahun';

                $pdf = PDF::loadview('backend.pages.report.admin.cetak_spm_sasaran', [
                    'data' => $data,
                    'agent' => $this->agent,
                    'kadis' => $this->kadis,
                    'tahun' => $tahun,
                    'att' => DataHelper::SPM_BULANAN,
                ]);
                $pdf->setPaper('A4', 'Landscape');
                return $pdf->download("Semua Puskesmas_Laporan SPM_SPM Sasaran_Tahun ${tahun}.pdf");
            } else {
                $data = SPMTarget::where('user_id', $user)
                    ->where('status_verifikasi', 2)
                    ->where('tahun', $tahun);

                if ($data->count() == 0) {
                    Alert::warning('Perhatian!', 'Data SPM - Data Sasaran pada tahun tersebut tidak ditemukan.');
                    return redirect()
                        ->route('dashboard.spm.report')
                        ->withInput();
                } else {
                    $data = $data->first();
                }

                if ($tahun == 'semua_tahun')
                    $tahun = 'Semua Tahun';

                $pdf = PDF::loadview('backend.pages.report.admin.cetak_spm_sasaran_single', [
                    'data' => $data,
                    'agent' => $this->agent,
                    'tahun' => $tahun,
                    'att' => DataHelper::SPM_BULANAN,
                ]);
                return $pdf->download($data->user->name . "_Laporan SPM_SPM Sasaran_Tahun ${tahun}.pdf");
            }
        } else if ($spm == 'data_tahunan') {
            if ($user == 'semua_puskesmas') {
                $data = SPMYearly::where('status_verifikasi', 2)
                    ->where('tahun', $tahun);

                if ($data->count() == 0) {
                    Alert::warning('Perhatian!', 'Data SPM - Data Tahunan pada tahun tersebut tidak ditemukan.');
                    return redirect()
                        ->route('dashboard.spm.report')
                        ->withInput();
                } else {
                    $data = $data->get();
                }

                if ($tahun == 'semua_tahun')
                    $tahun = 'Semua Tahun';

                $pdf = PDF::loadview('backend.pages.report.admin.cetak_spm_tahunan', [
                    'data' => $data,
                    'agent' => $this->agent,
                    'kadis' => $this->kadis,
                    'tahun' => $tahun,
                    'att' => DataHelper::SPM_TAHUNAN,
                ]);
                $pdf->setPaper('A4', 'Landscape');
                return $pdf->download("Semua Puskesmas_Laporan SPM_SPM Tahunan_Tahun ${tahun}.pdf");
            } else {
                $data = SPMYearly::where('user_id', $user)
                    ->where('status_verifikasi', 2)
                    ->where('tahun', $tahun);

                if ($data->count() == 0) {
                    Alert::warning('Perhatian!', 'Data SPM - Data Tahunan pada tahun tersebut tidak ditemukan.');
                    return redirect()
                        ->route('dashboard.spm.report')
                        ->withInput();
                } else {
                    $data = $data->first();
                }

                $pdf = PDF::loadview('backend.pages.report.admin.cetak_spm_tahunan_single', [
                    'data' => $data,
                    'agent' => $this->agent,
                    'tahun' => $tahun,
                    'att' => DataHelper::SPM_TAHUNAN,
                ]);
                return $pdf->download($data->user->name . "_Laporan SPM_SPM Tahunan_Tahun ${tahun}.pdf");
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
                ->route('dashboard.spm.target');

        if ($tahun == 'semua_data' || !$tahun)
            array_push($where, ['tahun', '!=', null]);
        else
            array_push($where, ['tahun', '=', $tahun]);

        if (Auth::user()->role_name == 'Puskesmas')
            array_push($where, ['user_id', Auth::id()]);
        else
            array_push($where, ['status_verifikasi', '!=', 0]);


        $data = SPMTarget::where($where)
            ->orderBy('tahun', 'desc')
            ->paginate(config('app.pagination_length'))->withQueryString();

        return view('backend.pages.spm.target.index', [
            'data' => $data,
            'tahun' => $tahun,
            'filter' => $filter
        ]);
    }

    public function target_show(SPMTarget $spm_target)
    {
        if ((Auth::user()->role_name == 'Puskesmas' && $spm_target->user_id != Auth::id()) || (Auth::user()->role_name != 'Puskesmas' && $spm_target->status_verifikasi == 0))
            return redirect()
                ->route('dashboard.spm.target');

        $riwayat = DataHistory::where('tipe_data', 'spm_data_sasaran')
            ->where('data_id', $spm_target->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view(
            'backend.pages.spm.target.show',
            [
                'data' => $spm_target,
                'att' => DataHelper::SPM_BULANAN,
                'riwayat' => $riwayat
            ]
        );
    }

    public function target_create()
    {
        return view('backend.pages.spm.target.create', [
            'att' => DataHelper::SPM_BULANAN
        ]);
    }

    public function target_store(Request $request)
    {
        $data_sasaran = SPMTarget::where('user_id', Auth::id())
            ->where('tahun', $request->tahun)
            ->count();

        if ($data_sasaran > 0) {
            Alert::info('Informasi!', 'Tahun tersebut telah ada sebelumnya. Silahkan periksa list SPM - Data Sasaran atau masukkan kembali tahun yang baru.');
            return redirect()
                ->route('dashboard.spm.target.create')
                ->withInput();
        }

        $validatedData = $request->validate(
            [
                'tahun' => 'required|numeric',
                'jml_ibu_hamil' => 'required|numeric',
                'jml_ibu_bersalin' => 'required|numeric',
                'jml_bayi_baru_lahir' => 'required|numeric',
                'jml_balita' => 'required|numeric',
                'jml_anak_kelas_1_7' => 'required|numeric',
                'jml_usia_15_59' => 'required|numeric',
                'jml_lansia' => 'required|numeric',
                'jml_penderita_hipertensi' => 'required|numeric',
                'jml_penyandang_dm' => 'required|numeric',
                'jml_odgj_berat' => 'required|numeric',
                'jml_penyandang_tb' => 'required|numeric',
                'jml_risiko_infeksi_hiv' => 'required|numeric',
                'satuan_jml_ibu_hamil' => 'required',
                'satuan_jml_ibu_bersalin' => 'required',
                'satuan_jml_bayi_baru_lahir' => 'required',
                'satuan_jml_balita' => 'required',
                'satuan_jml_anak_kelas_1_7' => 'required',
                'satuan_jml_usia_15_59' => 'required',
                'satuan_jml_lansia' => 'required',
                'satuan_jml_penderita_hipertensi' => 'required',
                'satuan_jml_penyandang_dm' => 'required',
                'satuan_jml_odgj_berat' => 'required',
                'satuan_jml_penyandang_tb' => 'required',
                'satuan_jml_risiko_infeksi_hiv' => 'required'
            ],
            [],
            [
                'jml_ibu_hamil' => 'Jumlah ibu hamil',
                'jml_ibu_bersalin' => 'Jumlah ibu bersalin',
                'jml_bayi_baru_lahir' => 'Jumlah bayi baru lahir',
                'jml_balita' => 'Jumlah balita',
                'jml_anak_kelas_1_7' => 'Jumlah anak usia pendidikan dasar kelas 1 dan 7',
                'jml_usia_15_59' => 'Jumlah warga negara usia 15-59 tahun',
                'jml_lansia' => 'Jumlah usia lanjut',
                'jml_penderita_hipertensi' => 'Jumlah penderita hipertensi',
                'jml_penyandang_dm' => 'Jumlah penyandang DM',
                'jml_odgj_berat' => 'Jumlah ODGJ berat',
                'jml_penyandang_tb' => 'Jumlah penyandang TB',
                'jml_risiko_infeksi_hiv' => 'Jumlah risiko infeksi HIV',
                'satuan_jml_ibu_hamil' => 'Satuan jumlah ibu hamil',
                'satuan_jml_ibu_bersalin' => 'Satuan jumlah ibu bersalin',
                'satuan_jml_bayi_baru_lahir' => 'Satuan jumlah bayi baru lahir',
                'satuan_jml_balita' => 'Satuan jumlah balita',
                'satuan_jml_anak_kelas_1_7' => 'Satuan jumlah anak usia pendidikan dasar kelas 1 dan 7',
                'satuan_jml_usia_15_59' => 'Satuan jumlah warga negara usia 15-59 tahun',
                'satuan_jml_lansia' => 'Satuan jumlah usia lanjut',
                'satuan_jml_penderita_hipertensi' => 'Satuan jumlah penderita hipertensi',
                'satuan_jml_penyandang_dm' => 'Satuan jumlah penyandang DM',
                'satuan_jml_odgj_berat' => 'Satuan jumlah ODGJ berat',
                'satuan_jml_penyandang_tb' => 'Satuan jumlah penyandang TB',
                'satuan_jml_risiko_infeksi_hiv' => 'Satuan jumlah risiko infeksi HIV'
            ]
        );

        $validatedData['user_id'] = Auth::id();
        $validatedData['slug'] = base64_encode(Str::random(8) . Carbon::now()->timestamp);

        $insert = SPMTarget::create($validatedData);

        $riwayat = [
            'deskripsi' => 'User menambahkan SPM - Data Sasaran tahun ' . $request->tahun,
            'tipe_data' => 'spm_data_sasaran',
            'data_id' =>  $insert->id,
            'user_id' => Auth::id(),
            'ip_address' => $request->ip()
        ];

        DataHistory::create($riwayat);

        Alert::success('Sukses!', 'Berhasil menambahkan SPM - Data Sasaran. Silahkan periksa kembali SPM - Data Sasaran sebelum dilakukan pengajuan untuk diverifikasi.');
        return redirect()
            ->route('dashboard.spm.target.show', $insert->slug);
    }

    public function target_edit(SPMTarget $spm_target)
    {
        if ((Auth::user()->role_name == 'Puskesmas' && $spm_target->user_id != Auth::id()) || (Auth::user()->role_name != 'Puskesmas' && $spm_target->status_verifikasi == 0))
            return redirect()
                ->route('dashboard.spm.target');

        if ($spm_target->status_verifikasi == 0 || $spm_target->status_verifikasi == 3)
            return view('backend.pages.spm.target.edit', [
                'data' => $spm_target,
                'att' => DataHelper::SPM_BULANAN
            ]);

        Alert::info('Informasi!', 'SPM - Data Sasaran tidak dapat diubah. ' . DataHelper::verification_message($spm_target->status_verifikasi));
        return redirect()
            ->route('dashboard.spm.target');
    }

    public function target_update(Request $request, SPMTarget $spm_target)
    {
        $riwayat_plus = '';

        if ($request->tahun != $spm_target->tahun) {
            $data_sasaran = SPMTarget::where('user_id', Auth::id())
                ->where('tahun', $request->tahun)
                ->count();
            $riwayat_plus = ' menjadi tahun ' . $request->tahun;

            if ($data_sasaran > 0) {
                Alert::info('Informasi!', 'Tahun tersebut telah ada sebelumnya. Silahkan periksa list SPM - Data Sasaran atau masukkan kembali tahun yang baru.');
                return redirect()
                    ->route('dashboard.spm.target.edit', $spm_target->slug)
                    ->withInput();
            }
        }

        $validatedData = $request->validate(
            [
                'tahun' => 'required|numeric',
                'jml_ibu_hamil' => 'required|numeric',
                'jml_ibu_bersalin' => 'required|numeric',
                'jml_bayi_baru_lahir' => 'required|numeric',
                'jml_balita' => 'required|numeric',
                'jml_anak_kelas_1_7' => 'required|numeric',
                'jml_usia_15_59' => 'required|numeric',
                'jml_lansia' => 'required|numeric',
                'jml_penderita_hipertensi' => 'required|numeric',
                'jml_penyandang_dm' => 'required|numeric',
                'jml_odgj_berat' => 'required|numeric',
                'jml_penyandang_tb' => 'required|numeric',
                'jml_risiko_infeksi_hiv' => 'required|numeric',
                'satuan_jml_ibu_hamil' => 'required',
                'satuan_jml_ibu_bersalin' => 'required',
                'satuan_jml_bayi_baru_lahir' => 'required',
                'satuan_jml_balita' => 'required',
                'satuan_jml_anak_kelas_1_7' => 'required',
                'satuan_jml_usia_15_59' => 'required',
                'satuan_jml_lansia' => 'required',
                'satuan_jml_penderita_hipertensi' => 'required',
                'satuan_jml_penyandang_dm' => 'required',
                'satuan_jml_odgj_berat' => 'required',
                'satuan_jml_penyandang_tb' => 'required',
                'satuan_jml_risiko_infeksi_hiv' => 'required'
            ],
            [],
            [
                'jml_ibu_hamil' => 'Jumlah ibu hamil',
                'jml_ibu_bersalin' => 'Jumlah ibu bersalin',
                'jml_bayi_baru_lahir' => 'Jumlah bayi baru lahir',
                'jml_balita' => 'Jumlah balita',
                'jml_anak_kelas_1_7' => 'Jumlah anak usia pendidikan dasar kelas 1 dan 7',
                'jml_usia_15_59' => 'Jumlah warga negara usia 15-59 tahun',
                'jml_lansia' => 'Jumlah usia lanjut',
                'jml_penderita_hipertensi' => 'Jumlah penderita hipertensi',
                'jml_penyandang_dm' => 'Jumlah penyandang DM',
                'jml_odgj_berat' => 'Jumlah ODGJ berat',
                'jml_penyandang_tb' => 'Jumlah penyandang TB',
                'jml_risiko_infeksi_hiv' => 'Jumlah risiko infeksi HIV',
                'satuan_jml_ibu_hamil' => 'Satuan jumlah ibu hamil',
                'satuan_jml_ibu_bersalin' => 'Satuan jumlah ibu bersalin',
                'satuan_jml_bayi_baru_lahir' => 'Satuan jumlah bayi baru lahir',
                'satuan_jml_balita' => 'Satuan jumlah balita',
                'satuan_jml_anak_kelas_1_7' => 'Satuan jumlah anak usia pendidikan dasar kelas 1 dan 7',
                'satuan_jml_usia_15_59' => 'Satuan jumlah warga negara usia 15-59 tahun',
                'satuan_jml_lansia' => 'Satuan jumlah usia lanjut',
                'satuan_jml_penderita_hipertensi' => 'Satuan jumlah penderita hipertensi',
                'satuan_jml_penyandang_dm' => 'Satuan jumlah penyandang DM',
                'satuan_jml_odgj_berat' => 'Satuan jumlah ODGJ berat',
                'satuan_jml_penyandang_tb' => 'Satuan jumlah penyandang TB',
                'satuan_jml_risiko_infeksi_hiv' => 'Satuan jumlah risiko infeksi HIV'
            ]
        );

        $validatedData['waktu_perubahan'] = Carbon::now();
        $validatedData['waktu_verifikasi'] = null;

        $riwayat = [
            'deskripsi' => 'User mengubah SPM - Data Sasaran tahun ' . $spm_target->tahun . $riwayat_plus,
            'tipe_data' => 'prioritas_data_sasaran',
            'data_id' =>  $spm_target->id,
            'user_id' => Auth::id(),
            'ip_address' => $request->ip()
        ];

        $spm_target->update($validatedData);

        DataHistory::create($riwayat);

        Alert::success('Sukses!', 'Berhasil mengubah SPM - Data Sasaran.');
        return redirect()
            ->route('dashboard.spm.target.show', $spm_target->slug);
    }

    public function target_submission(Request $request, SPMTarget $spm_target)
    {
        if ($spm_target->status_verifikasi == 0) {
            $update_data = [
                'status_verifikasi' => 1,
                'waktu_pengajuan' => Carbon::now()
            ];
            $msg = 'SPM - Data Sasaran berhasil diajukan. Silahkan tunggu pemberitahuan verifikasi data.';
            $riwayat_dari = "Draft";
            $riwayat_jadi = "Pengajuan";
        } elseif ($spm_target->status_verifikasi == 1) {
            $update_data = [
                'status_verifikasi' => 0,
                'waktu_pengajuan' => null
            ];
            $msg = 'Pembatalan pengajuan SPM - Data Sasaran berhasil.';
            $riwayat_dari = "Pengajuan";
            $riwayat_jadi = "Draft";
        } else if ($spm_target->status_verifikasi == 3) {
            $update_data = [
                'status_verifikasi' => 1,
                'waktu_pengajuan' => Carbon::now()
            ];
            $msg = 'SPM - Data Sasaran berhasil diajukan kembali. Silahkan tunggu pemberitahuan verifikasi data.';
            $riwayat_dari = "Diverifikasi";
            $riwayat_jadi = "Pengajuan";
        }

        $riwayat = [
            'deskripsi' => 'User mengubah pengajuan SPM - Data Sasaran tahun ' . $spm_target->tahun . ' dari ' . $riwayat_dari . ' menjadi ' . $riwayat_jadi,
            'tipe_data' => 'spm_data_sasaran',
            'data_id' =>  $spm_target->id,
            'user_id' => Auth::id(),
            'ip_address' => $request->ip()
        ];

        $spm_target->update($update_data);

        DataHistory::create($riwayat);
        Alert::success('Sukses!', $msg);
        return redirect()
            ->route('dashboard.spm.target.show', $spm_target->slug);
    }

    public function target_destroy(Request $request)
    {
        $slug = $request->v;
        $data = SPMTarget::where('user_id', Auth::id())
            ->where('slug', $slug);

        if ($data->count() == 0) {
            Alert::warning('Perhatian!', 'Data tidak sesuai dengan permintaan.');
            return redirect()
                ->route('dashboard.spm.target');
        } else {
            $data = $data->first();
            if ($data->status_verifikasi == 0) {
                SPMTarget::where('slug', $slug)
                    ->delete();

                $riwayat = [
                    'deskripsi' => 'User menghapus pengajuan SPM - Data Sasaran tahun ' . $data->tahun,
                    'tipe_data' => 'spm_data_sasaran',
                    'data_id' =>  $data->id,
                    'user_id' => Auth::id(),
                    'ip_address' => $request->ip()
                ];

                DataHistory::create($riwayat);
                Alert::success('Sukses!', 'SPM - Data Sasaran berhasil dihapus.');
                return redirect()
                    ->route('dashboard.spm.target');
            } else {
                Alert::info('Informasi!', 'SPM - Data Sasaran tidak dapat dihapus. ' . DataHelper::verification_message($data->status_verifikasi));
                return redirect()
                    ->route('dashboard.spm.target');
            }
        }
    }

    public function target_approval(Request $request, SPMTarget $spm_target)
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

        DataHistory::create([
            'deskripsi' => $riwayat_desk,
            'tipe_data' => 'spm_data_sasaran',
            'data_id' =>  $spm_target->id,
            'user_id' => Auth::id(),
            'ip_address' => $request->ip()
        ]);

        $spm_target->update($update_data);

        if ($verif_stat == 1)
            Alert::success('Sukses!', 'Berhasil melakukan penarikan verifikasi.');
        elseif ($verif_stat == 2)
            Alert::success('Sukses!', 'Berhasil melakukan verifikasi data.');
        else
            Alert::success('Sukses!', 'Berhasil melakukan penolakan data.');

        return redirect()
            ->route('dashboard.spm.target.show', $spm_target->slug);
    }
    // **                      **
    // *    END DATA SASARAN    *
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
                ->route('dashboard.spm.yearly');

        if ($tahun == 'semua_data' || !$tahun)
            array_push($where, ['tahun', '!=', null]);
        else
            array_push($where, ['tahun', '=', $tahun]);

        if (Auth::user()->role_name == 'Puskesmas')
            array_push($where, ['user_id', Auth::id()]);
        else
            array_push($where, ['status_verifikasi', '!=', 0]);

        $data = SPMYearly::where($where)
            ->orderBy('tahun', 'desc')
            ->paginate(config('app.pagination_length'))->withQueryString();

        return view('backend.pages.spm.yearly.index', [
            'data' => $data,
            'tahun' => $tahun,
            'filter' => $filter
        ]);
    }

    public function yearly_show(SPMYearly $spm_yearly)
    {
        if ((Auth::user()->role_name == 'Puskesmas' && $spm_yearly->user_id != Auth::id()) || (Auth::user()->role_name != 'Puskesmas' && $spm_yearly->status_verifikasi == 0))
            return redirect()
                ->route('dashboard.spm.yearly');

        $riwayat = DataHistory::where('tipe_data', 'spm')
            ->where('data_id', $spm_yearly->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view(
            'backend.pages.spm.yearly.show',
            [
                'data' => $spm_yearly,
                'att' => DataHelper::SPM_TAHUNAN,
                'riwayat' => $riwayat
            ]
        );
    }

    public function yearly_create()
    {
        return view('backend.pages.spm.yearly.create', [
            'att' => DataHelper::SPM_TAHUNAN,
        ]);
    }

    public function yearly_store(Request $request)
    {
        $data_tahunan = SPMYearly::where('user_id', Auth::id())
            ->where('tahun', $request->tahun)
            ->count();

        if ($data_tahunan > 0) {
            Alert::info('Informasi!', 'Tahun tersebut telah ada sebelumnya. Silahkan periksa list SPM - Data Tahunan atau masukkan kembali tahun yang baru.');
            return redirect()
                ->route('dashboard.spm.yearly.create')
                ->withInput();
        }

        $validatedData = $request->validate(
            [
                'tahun' => 'required|numeric',
                'jml_ibu_hamil' => 'required|numeric',
                'jml_ibu_bersalin' => 'required|numeric',
                'jml_bayi_baru_lahir' => 'required|numeric',
                'jml_balita' => 'required|numeric',
                'jml_anak_kelas_1_7' => 'required|numeric',
                'jml_usia_15_59' => 'required|numeric',
                'jml_lansia' => 'required|numeric',
                'jml_penderita_hipertensi' => 'required|numeric',
                'jml_penyandang_dm' => 'required|numeric',
                'jml_odgj_berat' => 'required|numeric',
                'jml_penyandang_tb' => 'required|numeric',
                'jml_risiko_infeksi_hiv' => 'required|numeric',
                'satuan_jml_ibu_hamil' => 'required',
                'satuan_jml_ibu_bersalin' => 'required',
                'satuan_jml_bayi_baru_lahir' => 'required',
                'satuan_jml_balita' => 'required',
                'satuan_jml_anak_kelas_1_7' => 'required',
                'satuan_jml_usia_15_59' => 'required',
                'satuan_jml_lansia' => 'required',
                'satuan_jml_penderita_hipertensi' => 'required',
                'satuan_jml_penyandang_dm' => 'required',
                'satuan_jml_odgj_berat' => 'required',
                'satuan_jml_penyandang_tb' => 'required',
                'satuan_jml_risiko_infeksi_hiv' => 'required'
            ],
            [],
            [
                'jml_ibu_hamil' => 'Jumlah ibu hamil',
                'jml_ibu_bersalin' => 'Jumlah ibu bersalin',
                'jml_bayi_baru_lahir' => 'Jumlah bayi baru lahir',
                'jml_balita' => 'Jumlah balita',
                'jml_anak_kelas_1_7' => 'Jumlah anak usia pendidikan dasar kelas 1 dan 7',
                'jml_usia_15_59' => 'Jumlah warga negara usia 15-59 tahun',
                'jml_lansia' => 'Jumlah usia lanjut',
                'jml_penderita_hipertensi' => 'Jumlah penderita hipertensi',
                'jml_penyandang_dm' => 'Jumlah penyandang DM',
                'jml_odgj_berat' => 'Jumlah ODGJ berat',
                'jml_penyandang_tb' => 'Jumlah penyandang TB',
                'jml_risiko_infeksi_hiv' => 'Jumlah risiko infeksi HIV',
                'satuan_jml_ibu_hamil' => 'Satuan jumlah ibu hamil',
                'satuan_jml_ibu_bersalin' => 'Satuan jumlah ibu bersalin',
                'satuan_jml_bayi_baru_lahir' => 'Satuan jumlah bayi baru lahir',
                'satuan_jml_balita' => 'Satuan jumlah balita',
                'satuan_jml_anak_kelas_1_7' => 'Satuan jumlah anak usia pendidikan dasar kelas 1 dan 7',
                'satuan_jml_usia_15_59' => 'Satuan jumlah warga negara usia 15-59 tahun',
                'satuan_jml_lansia' => 'Satuan jumlah usia lanjut',
                'satuan_jml_penderita_hipertensi' => 'Satuan jumlah penderita hipertensi',
                'satuan_jml_penyandang_dm' => 'Satuan jumlah penyandang DM',
                'satuan_jml_odgj_berat' => 'Satuan jumlah ODGJ berat',
                'satuan_jml_penyandang_tb' => 'Satuan jumlah penyandang TB',
                'satuan_jml_risiko_infeksi_hiv' => 'Satuan jumlah risiko infeksi HIV'
            ]
        );

        $validatedData['user_id'] = Auth::id();
        $validatedData['slug'] = base64_encode(Str::random(8) . Carbon::now()->timestamp);

        $insert = SPMYearly::create($validatedData);

        $riwayat = [
            'deskripsi' => 'User menambahkan SPM - Data Tahunan tahun ' . $request->tahun,
            'tipe_data' => 'spm',
            'data_id' =>  $insert->id,
            'user_id' => Auth::id(),
            'ip_address' => $request->ip()
        ];

        DataHistory::create($riwayat);

        Alert::success('Sukses!', 'Berhasil menambahkan SPM - Data Tahunan. Silahkan periksa kembali SPM - Data Tahunan sebelum dilakukan pengajuan untuk diverifikasi.');
        return redirect()
            ->route('dashboard.spm.yearly.show', $insert->slug);
    }

    public function yearly_edit(SPMYearly $spm_yearly)
    {
        if ((Auth::user()->role_name == 'Puskesmas' && $spm_yearly->user_id != Auth::id()) || (Auth::user()->role_name != 'Puskesmas' && $spm_yearly->status_verifikasi == 0))
            return redirect()
                ->route('dashboard.spm.yearly');

        if ($spm_yearly->status_verifikasi == 0 || $spm_yearly->status_verifikasi == 3)
            return view('backend.pages.spm.yearly.edit', [
                'data' => $spm_yearly,
                'att' => DataHelper::SPM_TAHUNAN,
            ]);

        Alert::info('Informasi!', 'SPM - Data Tahunan tidak dapat diubah. ' . DataHelper::verification_message($spm_yearly->status_verifikasi));
        return redirect()
            ->route('dashboard.spm.yearly');
    }

    public function yearly_update(Request $request, SPMYearly $spm_yearly)
    {
        $riwayat_plus = '';

        if ($spm_yearly->tahun != $request->tahun) {
            $data_tahunan = SPMYearly::where('user_id', Auth::id())
                ->where('tahun', $request->tahun)
                ->count();
            $riwayat_plus = ' menjadi tahun ' . $request->tahun;

            if ($data_tahunan > 0) {
                Alert::info('Informasi!', 'Tahun tersebut telah ada sebelumnya. Silahkan periksa list SPM - Data Tahunan atau masukkan kembali tahun yang baru.');
                return redirect()
                    ->route('dashboard.spm.yearly.edit', $spm_yearly->slug)
                    ->withInput();
            }
        }

        $validatedData = $request->validate(
            [
                'tahun' => 'required|numeric',
                'jml_ibu_hamil' => 'required|numeric',
                'jml_ibu_bersalin' => 'required|numeric',
                'jml_bayi_baru_lahir' => 'required|numeric',
                'jml_balita' => 'required|numeric',
                'jml_anak_kelas_1_7' => 'required|numeric',
                'jml_usia_15_59' => 'required|numeric',
                'jml_lansia' => 'required|numeric',
                'jml_penderita_hipertensi' => 'required|numeric',
                'jml_penyandang_dm' => 'required|numeric',
                'jml_odgj_berat' => 'required|numeric',
                'jml_penyandang_tb' => 'required|numeric',
                'jml_risiko_infeksi_hiv' => 'required|numeric',
                'satuan_jml_ibu_hamil' => 'required',
                'satuan_jml_ibu_bersalin' => 'required',
                'satuan_jml_bayi_baru_lahir' => 'required',
                'satuan_jml_balita' => 'required',
                'satuan_jml_anak_kelas_1_7' => 'required',
                'satuan_jml_usia_15_59' => 'required',
                'satuan_jml_lansia' => 'required',
                'satuan_jml_penderita_hipertensi' => 'required',
                'satuan_jml_penyandang_dm' => 'required',
                'satuan_jml_odgj_berat' => 'required',
                'satuan_jml_penyandang_tb' => 'required',
                'satuan_jml_risiko_infeksi_hiv' => 'required'
            ],
            [],
            [
                'jml_ibu_hamil' => 'Jumlah ibu hamil',
                'jml_ibu_bersalin' => 'Jumlah ibu bersalin',
                'jml_bayi_baru_lahir' => 'Jumlah bayi baru lahir',
                'jml_balita' => 'Jumlah balita',
                'jml_anak_kelas_1_7' => 'Jumlah anak usia pendidikan dasar kelas 1 dan 7',
                'jml_usia_15_59' => 'Jumlah warga negara usia 15-59 tahun',
                'jml_lansia' => 'Jumlah usia lanjut',
                'jml_penderita_hipertensi' => 'Jumlah penderita hipertensi',
                'jml_penyandang_dm' => 'Jumlah penyandang DM',
                'jml_odgj_berat' => 'Jumlah ODGJ berat',
                'jml_penyandang_tb' => 'Jumlah penyandang TB',
                'jml_risiko_infeksi_hiv' => 'Jumlah risiko infeksi HIV',
                'satuan_jml_ibu_hamil' => 'Satuan jumlah ibu hamil',
                'satuan_jml_ibu_bersalin' => 'Satuan jumlah ibu bersalin',
                'satuan_jml_bayi_baru_lahir' => 'Satuan jumlah bayi baru lahir',
                'satuan_jml_balita' => 'Satuan jumlah balita',
                'satuan_jml_anak_kelas_1_7' => 'Satuan jumlah anak usia pendidikan dasar kelas 1 dan 7',
                'satuan_jml_usia_15_59' => 'Satuan jumlah warga negara usia 15-59 tahun',
                'satuan_jml_lansia' => 'Satuan jumlah usia lanjut',
                'satuan_jml_penderita_hipertensi' => 'Satuan jumlah penderita hipertensi',
                'satuan_jml_penyandang_dm' => 'Satuan jumlah penyandang DM',
                'satuan_jml_odgj_berat' => 'Satuan jumlah ODGJ berat',
                'satuan_jml_penyandang_tb' => 'Satuan jumlah penyandang TB',
                'satuan_jml_risiko_infeksi_hiv' => 'Satuan jumlah risiko infeksi HIV'
            ]
        );

        $validatedData['waktu_perubahan'] = Carbon::now();
        $validatedData['waktu_verifikasi'] = null;

        $riwayat = [
            'deskripsi' => 'User mengubah SPM - Data Tahunan tahun ' . $spm_yearly->tahun . $riwayat_plus,
            'tipe_data' => 'spm',
            'data_id' =>  $spm_yearly->id,
            'user_id' => Auth::id(),
            'ip_address' => $request->ip()
        ];

        $spm_yearly->update($validatedData);

        DataHistory::create($riwayat);

        Alert::success('Sukses!', 'Berhasil mengubah SPM - Data Tahunan.');
        return redirect()
            ->route('dashboard.spm.yearly.show', $spm_yearly->slug);
    }

    public function yearly_submission(Request $request, SPMYearly $spm_yearly)
    {
        if ($spm_yearly->status_verifikasi == 0) {
            $update_data = [
                'status_verifikasi' => 1,
                'waktu_pengajuan' => Carbon::now()
            ];
            $msg = 'SPM - Data Tahunan berhasil diajukan. Silahkan tunggu pemberitahuan verifikasi data.';
            $riwayat_dari = 0;
            $riwayat_jadi = 1;
        } elseif ($spm_yearly->status_verifikasi == 1) {
            $update_data = [
                'status_verifikasi' => 0,
                'waktu_pengajuan' => null
            ];
            $msg = 'Pembatalan pengajuan SPM - Data Tahunan berhasil.';
            $riwayat_dari = 1;
            $riwayat_jadi = 0;
        } else if ($spm_yearly->status_verifikasi == 3) {
            $update_data = [
                'status_verifikasi' => 1,
                'waktu_pengajuan' => Carbon::now()
            ];
            $msg = 'SPM - Data Tahunan berhasil diajukan kembali. Silahkan tunggu pemberitahuan verifikasi data.';
            $riwayat_dari = 3;
            $riwayat_jadi = 1;
        }

        $riwayat = [
            'deskripsi' => 'User mengubah pengajuan SPM - Data Tahunan tahun ' . $spm_yearly->tahun . ' dari ' . $riwayat_dari . ' menjadi ' . $riwayat_jadi,
            'tipe_data' => 'spm',
            'data_id' =>  $spm_yearly->id,
            'user_id' => Auth::id(),
            'ip_address' => $request->ip()
        ];

        $spm_yearly->update($update_data);

        DataHistory::create($riwayat);
        Alert::success('Sukses!', $msg);
        return redirect()
            ->route('dashboard.spm.yearly.show', $spm_yearly->slug);
    }

    public function yearly_destroy(Request $request)
    {
        $slug = $request->v;
        $data = SPMYearly::where('user_id', Auth::id())
            ->where('slug', $slug);

        if ($data->count() == 0) {
            Alert::warning('Perhatian!', 'Data tidak sesuai dengan permintaan.');
            return redirect()
                ->route('dashboard.spm.yearly');
        } else {
            $data = $data->first();
            if ($data->status_verifikasi == 0) {
                SPMYearly::where('slug', $slug)
                    ->delete();

                $riwayat = [
                    'deskripsi' => 'User menghapus pengajuan SPM - Data Tahunan tahun ' . $data->tahun,
                    'tipe_data' => 'spm',
                    'data_id' =>  $data->id,
                    'user_id' => Auth::id(),
                    'ip_address' => $request->ip()
                ];

                DataHistory::create($riwayat);
                Alert::success('Sukses!', 'SPM - Data Tahunan berhasil dihapus.');
                return redirect()
                    ->route('dashboard.spm.yearly');
            } else {
                Alert::info('Informasi!', 'SPM - Data Tahunan tidak dapat dihapus. ' . DataHelper::verification_message($data->status_verifikasi));
                return redirect()
                    ->route('dashboard.spm.yearly');
            }
        }
    }

    public function yearly_approval(Request $request, SPMYearly $spm_yearly)
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

        DataHistory::create([
            'deskripsi' => $riwayat_desk,
            'tipe_data' => 'spm_data_tahunan',
            'data_id' =>  $spm_yearly->id,
            'user_id' => Auth::id(),
            'ip_address' => $request->ip()
        ]);

        $spm_yearly->update($update_data);

        if ($verif_stat == 1)
            Alert::success('Sukses!', 'Berhasil melakukan penarikan verifikasi.');
        elseif ($verif_stat == 2)
            Alert::success('Sukses!', 'Berhasil melakukan verifikasi data.');
        else
            Alert::success('Sukses!', 'Berhasil melakukan penolakan data.');

        return redirect()
            ->route('dashboard.spm.yearly.show', $spm_yearly->slug);
    }
    // **                      **
    // *    END DATA TAHUNAN    *
    // **  
}
