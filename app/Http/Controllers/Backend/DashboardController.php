<?php

namespace App\Http\Controllers\Backend;

use App\Models\SPMTarget;
use App\Models\SPMYearly;
use App\Models\Notification;
use App\Models\PriorityTarget;
use App\Models\PriorityYearly;
use App\Models\PriorityMonthly;
use Illuminate\Support\Facades\Auth;

class DashboardController extends BackendController
{
    // Kode Notifikasi
    // 0. Draft
    // 1. Proses Pemeriksaan
    // 2. Verifikasi
    // 3. Periksa Kembali

    // VALUE INPUT DATA PUSKESMAS

    public function index()
    {
        if (Auth::user()->role_name == 'Puskesmas')
            return $this->user();

        return $this->administrator();
    }

    public function user()
    {
        $prioritas_sasaran = PriorityTarget::get();
        $prioritas_bulanan = PriorityMonthly::get();
        $prioritas_tahunan = PriorityYearly::get();

        $prioritas_sasaran_count = $prioritas_sasaran->where('user_id', Auth::id())
            ->count();
        $prioritas_bulanan_count = $prioritas_bulanan->where('user_id', Auth::id())
            ->count();
        $prioritas_tahunan_count = $prioritas_tahunan->where('user_id', Auth::id())
            ->count();

        $total_prioritas = $prioritas_sasaran_count + $prioritas_bulanan_count + $prioritas_tahunan_count;
        $pembagi_prioritas = $total_prioritas > 0 ? $total_prioritas : 1;

        $spm_sasaran = SPMTarget::get();
        $spm_tahunan = SPMYearly::get();

        $spm_sasaran_count = $spm_sasaran->where('user_id', Auth::id())
            ->count();
        $spm_tahunan_count = $spm_tahunan->where('user_id', Auth::id())
            ->count();

        $total_spm = $spm_sasaran_count + $spm_tahunan_count;
        $pembagi_spm = $total_spm > 0 ? $total_spm : 1;

        $data_index = [
            ['label' => 'Template Prioritas', 'items' => [
                ['title' => 'Total Data', 'item' => $total_prioritas, 'type' => 0, 'link' => route('dashboard.priority'), 'percentage' => ($total_prioritas / $pembagi_prioritas * 100)],
                ['title' => 'Data Sasaran', 'item' => $prioritas_sasaran_count, 'type' => 1, 'link' => route('dashboard.priority.target'), 'percentage' => ($prioritas_sasaran_count / $pembagi_prioritas * 100)],
                ['title' => 'Data Bulanan', 'item' => $prioritas_bulanan_count, 'type' => 2, 'link' => route('dashboard.priority.monthly'), 'percentage' => ($prioritas_bulanan_count / $pembagi_prioritas * 100)],
                ['title' => 'Data Tahunan', 'item' => $prioritas_tahunan_count, 'type' => 3, 'link' => route('dashboard.priority.yearly'), 'percentage' => ($prioritas_tahunan_count / $pembagi_prioritas * 100)],
            ]],
            ['label' => 'SPM', 'items' => [
                ['title' => 'Total Data', 'item' => $total_spm, 'type' => 0, 'link' => route('dashboard.spm'), 'percentage' => ($total_spm / $pembagi_spm * 100)],
                ['title' => 'Data Sasaran', 'item' => $spm_sasaran_count, 'type' => 1, 'link' => route('dashboard.spm.target'), 'percentage' => ($spm_sasaran_count / $pembagi_spm * 100)],
                ['title' => 'Data Tahunan', 'item' => $spm_tahunan_count, 'type' => 2, 'link' => route('dashboard.spm.yearly'), 'percentage' => ($spm_tahunan_count / $pembagi_spm * 100)]
            ]],

        ];

        $notif_prioritas_sasaran = $prioritas_sasaran->where('user_id', Auth::id())
            ->where('status_verifikasi', 3)
            ->first();
        $notif_prioritas_bulanan = $prioritas_bulanan->where('user_id', Auth::id())
            ->where('status_verifikasi', 3)
            ->first();
        $notif_prioritas_tahunan = $prioritas_tahunan->where('user_id', Auth::id())
            ->where('status_verifikasi', 3)
            ->first();

        $notif_spm_sasaran = $spm_sasaran->where('user_id', Auth::id())
            ->where('status_verifikasi', 3)
            ->first();
        $notif_spm_tahunan = $spm_tahunan->where('user_id', Auth::id())
            ->where('status_verifikasi', 3)
            ->first();

        $notification = Notification::where('is_active', 1)
            ->first();

        // ddd(\App\Helpers\DataHelper::get_backend_sidebar_menus()); //TESTER DATA HELPER
        return view('backend.pages.dashboard.user', [
            'data_index' => $data_index,
            'nps' => $notif_prioritas_sasaran,
            'npb' => $notif_prioritas_bulanan,
            'npt' => $notif_prioritas_tahunan,
            'nss' => $notif_spm_sasaran,
            'nst' => $notif_spm_tahunan,
            'notification' => $notification,
        ]);
    }

    public function administrator()
    {
        $prioritas_sasaran = PriorityTarget::get();
        $prioritas_bulanan = PriorityMonthly::get();
        $prioritas_tahunan = PriorityYearly::get();

        $prioritas_sasaran_count = $prioritas_sasaran->where('status_verifikasi', '!=', 0)
            ->count();
        $prioritas_bulanan_count = $prioritas_bulanan->where('status_verifikasi', '!=', 0)
            ->count();
        $prioritas_tahunan_count = $prioritas_tahunan->where('status_verifikasi', '!=', 0)
            ->count();

        $total_prioritas = $prioritas_sasaran_count + $prioritas_bulanan_count + $prioritas_tahunan_count;
        $pembagi_prioritas = $total_prioritas > 0 ? $total_prioritas : 1;

        $spm_sasaran = SPMTarget::get();
        $spm_tahunan = SPMYearly::get();

        $spm_sasaran_count = $spm_sasaran->where('status_verifikasi', '!=', 0)
            ->count();
        $spm_tahunan_count = $spm_tahunan->where('status_verifikasi', '!=', 0)
            ->count();

        $total_spm = $spm_sasaran_count + $spm_tahunan_count;
        $pembagi_spm = $total_spm > 0 ? $total_spm : 1;

        $data_index = [
            ['label' => 'Template Prioritas', 'items' => [
                ['title' => 'Total Data', 'item' => $total_prioritas, 'type' => 0, 'link' => '#', 'percentage' => ($total_prioritas / $pembagi_prioritas * 100)],
                ['title' => 'Data Sasaran', 'item' => $prioritas_sasaran_count, 'type' => 1, 'link' => route('dashboard.priority.target'), 'percentage' => ($prioritas_sasaran_count / $pembagi_prioritas * 100)],
                ['title' => 'Data Bulanan', 'item' => $prioritas_bulanan_count, 'type' => 2, 'link' => route('dashboard.priority.monthly'), 'percentage' => ($prioritas_bulanan_count / $pembagi_prioritas * 100)],
                ['title' => 'Data Tahunan', 'item' => $prioritas_tahunan_count, 'type' => 3, 'link' => route('dashboard.priority.yearly'), 'percentage' => ($prioritas_tahunan_count / $pembagi_prioritas * 100)],
            ]],
            ['label' => 'SPM', 'items' => [
                ['title' => 'Total Data', 'item' => $total_spm, 'type' => 0, 'link' => '#', 'percentage' => ($total_spm / $pembagi_spm * 100)],
                ['title' => 'Data Sasaran', 'item' => $spm_sasaran_count, 'type' => 1, 'link' => route('dashboard.spm.target'), 'percentage' => ($spm_sasaran_count / $pembagi_spm * 100)],
                ['title' => 'Data Tahunan', 'item' => $spm_tahunan_count, 'type' => 2, 'link' => route('dashboard.spm.yearly'), 'percentage' => ($spm_tahunan_count / $pembagi_spm * 100)]
            ]],

        ];

        $sasaran_count = $prioritas_sasaran->count();
        $sasaran_count = $sasaran_count > 0 ? $sasaran_count : 1;

        $sasaran_1 = $prioritas_sasaran->where('status_verifikasi', 1)
            ->count();
        $sasaran_2 = $prioritas_sasaran->where('status_verifikasi', 2)
            ->count();
        $sasaran_3 = $prioritas_sasaran->where('status_verifikasi', 3)
            ->count();

        $bulanan_count = $prioritas_bulanan->count();
        $bulanan_count = $bulanan_count > 0 ? $bulanan_count : 1;

        $bulanan_1 = $prioritas_bulanan->where('status_verifikasi', 1)
            ->count();
        $bulanan_2 = $prioritas_bulanan->where('status_verifikasi', 2)
            ->count();
        $bulanan_3 = $prioritas_bulanan->where('status_verifikasi', 3)
            ->count();

        $tahunan_count = $prioritas_tahunan->count();
        $tahunan_count = $tahunan_count > 0 ? $tahunan_count : 1;

        $tahunan_1 = $prioritas_tahunan->where('status_verifikasi', 1)
            ->count();
        $tahunan_2 = $prioritas_tahunan->where('status_verifikasi', 2)
            ->count();
        $tahunan_3 = $prioritas_tahunan->where('status_verifikasi', 3)
            ->count();

        $prioritas = [
            ['label' => 'Template Prioritas - Data Sasaran', 'items' => [
                ['item' => $sasaran_1, 'type' => 1, 'link' => route('dashboard.priority.target', ['filter' => 'proses_pemeriksaan']), 'percentage' => ($sasaran_1 / $sasaran_count * 100)],
                ['item' => $sasaran_2, 'type' => 2, 'link' => route('dashboard.priority.target', ['filter' => 'verifikasi']), 'percentage' => ($sasaran_2 / $sasaran_count * 100)],
                ['item' => $sasaran_3, 'type' => 3, 'link' => route('dashboard.priority.target', ['filter' => 'periksa_ulang']), 'percentage' => ($sasaran_3 / $sasaran_count * 100)],
            ]],
            ['label' => 'Template Prioritas - Data Bulanan', 'items' => [
                ['item' => $bulanan_1, 'type' => 1, 'link' => route('dashboard.priority.monthly', ['filter' => 'proses_pemeriksaan']), 'percentage' => ($bulanan_1 / $bulanan_count * 100)],
                ['item' => $bulanan_2, 'type' => 2, 'link' => route('dashboard.priority.monthly', ['filter' => 'verifikasi']), 'percentage' => ($bulanan_2 / $bulanan_count * 100)],
                ['item' => $bulanan_3, 'type' => 3, 'link' => route('dashboard.priority.monthly', ['filter' => 'periksa_ulang']), 'percentage' => ($bulanan_3 / $bulanan_count * 100)],
            ]],
            ['label' => 'Template Prioritas - Data Tahunan', 'items' => [
                ['item' => $tahunan_1, 'type' => 1, 'link' => route('dashboard.priority.yearly', ['filter' => 'proses_pemeriksaan']), 'percentage' => ($tahunan_1 / $tahunan_count * 100)],
                ['item' => $tahunan_2, 'type' => 2, 'link' => route('dashboard.priority.yearly', ['filter' => 'verifikasi']), 'percentage' => ($tahunan_2 / $tahunan_count * 100)],
                ['item' => $tahunan_3, 'type' => 3, 'link' => route('dashboard.priority.yearly', ['filter' => 'periksa_ulang']), 'percentage' => ($tahunan_3 / $tahunan_count * 100)],
            ]],
        ];

        $sasaran_count = $spm_sasaran->count();
        $sasaran_count = $sasaran_count > 0 ? $sasaran_count : 1;

        $sasaran_1 = $spm_sasaran->where('status_verifikasi', 1)
            ->count();
        $sasaran_2 = $spm_sasaran->where('status_verifikasi', 2)
            ->count();
        $sasaran_3 = $spm_sasaran->where('status_verifikasi', 3)
            ->count();

        $tahunan_count = $spm_tahunan->count();
        $tahunan_count = $tahunan_count > 0 ? $tahunan_count : 1;

        $tahunan_1 = $spm_tahunan->where('status_verifikasi', 1)
            ->count();
        $tahunan_2 = $spm_tahunan->where('status_verifikasi', 2)
            ->count();
        $tahunan_3 = $spm_tahunan->where('status_verifikasi', 3)
            ->count();

        $spm_count = [
            ['label' => 'SPM - Data Sasaran',  'items' => [
                ['item' => $sasaran_1, 'type' => 1, 'link' => route('dashboard.spm.target', ['filter' => 'proses_pemeriksaan']), 'percentage' => ($sasaran_1 / $sasaran_count * 100)],
                ['item' => $sasaran_2, 'type' => 2, 'link' => route('dashboard.spm.target', ['filter' => 'verifikasi']), 'percentage' => ($sasaran_2 / $sasaran_count * 100)],
                ['item' => $sasaran_3, 'type' => 3, 'link' => route('dashboard.spm.target', ['filter' => 'periksa_ulang']), 'percentage' => ($sasaran_3 / $sasaran_count * 100)],
            ]],
            ['label' => 'SPM - Data Tahunan',  'items' => [
                ['item' => $tahunan_1, 'type' => 1, 'link' => route('dashboard.spm.yearly', ['filter' => 'proses_pemeriksaan']), 'percentage' => ($tahunan_1 / $tahunan_count * 100)],
                ['item' => $tahunan_2, 'type' => 2, 'link' => route('dashboard.spm.yearly', ['filter' => 'verifikasi']), 'percentage' => ($tahunan_2 / $tahunan_count * 100)],
                ['item' => $tahunan_3, 'type' => 3, 'link' => route('dashboard.spm.yearly', ['filter' => 'periksa_ulang']), 'percentage' => ($tahunan_3 / $tahunan_count * 100)],
            ]],
        ];

        $notification = Notification::where('is_active', 1)
            ->first();

        return view('backend.pages.dashboard.admin', [
            'data_index' => $data_index,
            'prioritas' => $prioritas,
            'spm' => $spm_count,
            'notification' => $notification
        ]);
    }
}
