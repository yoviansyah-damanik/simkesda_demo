<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\SPMController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\DinasController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\AccountController;
use App\Http\Controllers\Backend\PriorityController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\AnnouncementController;
use App\Http\Controllers\backend\NotificationController;
use App\Http\Controllers\Backend\PuskesmasProfileController;

Route::middleware('auth')
    ->as('dashboard.')
    ->prefix('dashboard')
    ->group(function () {
        // Account
        Route::controller(AccountController::class)
            ->group(function () {
                Route::get('/akun',  'index')
                    ->name('account');
                Route::put('/akun',  'update_account')
                    ->name('account.update');

                Route::get('/akun/kata_sandi',  'password')
                    ->name('account.password');
                Route::put('/akun/kata_sandi',  'update_password')
                    ->name('account.password.update');
            });
    });

Route::middleware('auth', 'isEntried')
    ->prefix('dashboard')
    ->get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::middleware('auth', 'isEntried')
    ->as('dashboard.')
    ->prefix('dashboard')
    ->group(function () {
        /*
    * For All Role
    */

        // PUSKESMAS
        Route::controller(PuskesmasProfileController::class)
            ->group(function () {
                Route::get('/puskesmas',  'index')
                    ->name('puskesmas');
                Route::get('/puskesmas/lihat/{puskesmas_profile:slug}',  'show')
                    ->name('puskesmas.show');
                Route::delete('/puskesmas',  'destroy')
                    ->name('puskesmas.destroy');
            });

        // Priority
        Route::controller(PriorityController::class)
            ->group(function () {
                // All
                Route::get('/template_prioritas',  'index')
                    ->name('priority');
                Route::get('/template_prioritas/laporan',  'report')
                    ->name('priority.report');

                // Priority Target
                Route::get('/template_prioritas/data_sasaran',  'target')
                    ->name('priority.target');
                Route::get('/template_prioritas/data_sasaran/lihat/{priority_target:slug}',  'target_show')
                    ->name('priority.target.show');

                // Priority Monthly
                Route::get('/template_prioritas/data_bulanan',  'monthly')
                    ->name('priority.monthly');
                Route::get('/template_prioritas/data_bulanan/lihat/{priority_monthly:slug}',  'monthly_show')
                    ->name('priority.monthly.show');

                // Priority Yearly
                Route::get('/template_prioritas/data_tahunan',  'yearly')
                    ->name('priority.yearly');
                Route::get('/template_prioritas/data_tahunan/lihat/{priority_yearly:slug}',  'yearly_show')
                    ->name('priority.yearly.show');
            });

        // SPM
        Route::controller(SPMController::class)
            ->group(function () {
                // All
                Route::get('/spm',  'index')
                    ->name('spm');
                Route::get('/spm/laporan',  'report')
                    ->name('spm.report');

                // Spm Target
                Route::get('/spm/data_sasaran',  'target')
                    ->name('spm.target');
                Route::get('/spm/data_sasaran/lihat/{spm_target:slug}',  'target_show')
                    ->name('spm.target.show');

                // Spm Yearly
                Route::get('/spm/data_tahunan',  'yearly')
                    ->name('spm.yearly');
                Route::get('/spm/data_tahunan/lihat/{spm_yearly:slug}',  'yearly_show')
                    ->name('spm.yearly.show');
            });

        /*
    * End of For All Role
    */

        /*
    * Puskesmas Only
    */
        Route::middleware('role:Puskesmas')
            ->group(function () {
                // PUSKESMAS
                Route::controller(PuskesmasProfileController::class)
                    ->group(function () {
                        Route::get('/puskesmas/tambah',  'create')
                            ->name('puskesmas.create');
                        Route::post('/puskesmas/tambah',  'store')
                            ->name('puskesmas.store');
                        Route::get('/puskesmas/ubah/{puskesmas_profile:slug}',  'edit')
                            ->name('puskesmas.edit');
                        Route::put('/puskesmas/ubah/{puskesmas_profile:slug}',  'update')
                            ->name('puskesmas.update');
                    });

                // PRIORITY
                Route::controller(PriorityController::class)
                    ->group(function () {
                        Route::post('/template_prioritas/laporan/pengguna',  'download_user')
                            ->name('priority.report.user');

                        // Priority Target
                        Route::get('/template_prioritas/data_sasaran/tambah',  'target_create')
                            ->name('priority.target.create');
                        Route::post('/template_prioritas/data_sasaran/tambah',  'target_store')
                            ->name('priority.target.store');
                        Route::get('/template_prioritas/data_sasaran/ubah/{priority_target:slug}',  'target_edit')
                            ->name('priority.target.edit');
                        Route::put('/template_prioritas/data_sasaran/ubah/{priority_target:slug}',  'target_update')
                            ->name('priority.target.update');
                        Route::put('/template_prioritas/data_sasaran/pengajuan/{priority_target:slug}',  'target_submission')
                            ->name('priority.target.submission');
                        Route::delete('/template_prioritas/data_sasaran/hapus',  'target_destroy')
                            ->name('priority.target.destroy');

                        // Priority Monthly
                        Route::get('/template_prioritas/data_bulanan/tambah',  'monthly_create')
                            ->name('priority.monthly.create');
                        Route::post('/template_prioritas/data_bulanan/tambah',  'monthly_store')
                            ->name('priority.monthly.store');
                        Route::get('/template_prioritas/data_bulanan/ubah/{priority_monthly:slug}',  'monthly_edit')
                            ->name('priority.monthly.edit');
                        Route::put('/template_prioritas/data_bulanan/ubah/{priority_monthly:slug}',  'monthly_update')
                            ->name('priority.monthly.update');
                        Route::put('/template_prioritas/data_bulanan/pengajuan/{priority_monthly:slug}',  'monthly_submission')
                            ->name('priority.monthly.submission');
                        Route::delete('/template_prioritas/data_bulanan/hapus',  'monthly_destroy')
                            ->name('priority.monthly.destroy');

                        // Priority Yearly
                        Route::get('/template_prioritas/data_tahunan/tambah',  'yearly_create')
                            ->name('priority.yearly.create');
                        Route::post('/template_prioritas/data_tahunan/tambah',  'yearly_store')
                            ->name('priority.yearly.store');
                        Route::get('/template_prioritas/data_tahunan/ubah/{priority_yearly:slug}',  'yearly_edit')
                            ->name('priority.yearly.edit');
                        Route::put('/template_prioritas/data_tahunan/ubah/{priority_yearly:slug}',  'yearly_update')
                            ->name('priority.yearly.update');
                        Route::put('/template_prioritas/data_tahunan/pengajuan/{priority_yearly:slug}',  'yearly_submission')
                            ->name('priority.yearly.submission');
                        Route::delete('/template_prioritas/data_tahunan/hapus',  'yearly_destroy')
                            ->name('priority.yearly.destroy');
                    });

                // SPM
                Route::controller(SpmController::class)
                    ->group(function () {
                        Route::post('/spm/laporan/pengguna',  'download_user')
                            ->name('spm.report.user');

                        // SPM Target
                        Route::get('/spm/data_sasaran/tambah',  'target_create')
                            ->name('spm.target.create');
                        Route::post('/spm/data_sasaran/tambah',  'target_store')
                            ->name('spm.target.store');
                        Route::get('/spm/data_sasaran/ubah/{spm_target:slug}',  'target_edit')
                            ->name('spm.target.edit');
                        Route::put('/spm/data_sasaran/ubah/{spm_target:slug}',  'target_update')
                            ->name('spm.target.update');
                        Route::put('/spm/data_sasaran/pengajuan/{spm_target:slug}',  'target_submission')
                            ->name('spm.target.submission');
                        Route::delete('/spm/data_sasaran/hapus',  'target_destroy')
                            ->name('spm.target.destroy');

                        // SPM Yearly
                        Route::get('/spm/data_tahunan/tambah',  'yearly_create')
                            ->name('spm.yearly.create');
                        Route::post('/spm/data_tahunan/tambah',  'yearly_store')
                            ->name('spm.yearly.store');
                        Route::get('/spm/data_tahunan/ubah/{spm_yearly:slug}',  'yearly_edit')
                            ->name('spm.yearly.edit');
                        Route::put('/spm/data_tahunan/ubah/{spm_yearly:slug}',  'yearly_update')
                            ->name('spm.yearly.update');
                        Route::put('/spm/data_tahunan/pengajuan/{spm_yearly:slug}',  'yearly_submission')
                            ->name('spm.yearly.submission');
                        Route::delete('/spm/data_tahunan/hapus',  'yearly_destroy')
                            ->name('spm.yearly.destroy');
                    });
            });
        /*
    * End of Puskesmas Only
    */

        /*
    * Administrator Only
    */
        Route::middleware('role:Superadmin|Administrator')
            ->group(function () {
                // Dinas
                Route::controller(DinasController::class)
                    ->group(function () {
                        Route::get('/dinas',  'index')
                            ->name('dinas');
                        Route::put('/dinas',  'update')
                            ->name('dinas.update');
                    });

                // Post
                Route::controller(PostController::class)
                    ->group(function () {
                        Route::get('/berita',  'index')
                            ->name('post');
                        Route::get('/berita/tambah', 'create')
                            ->name('post.create');
                        Route::post('/berita/tambah', 'store')
                            ->name('post.store');
                        Route::put('/berita/publish', 'publish')
                            ->name('post.publish');
                        Route::get('/berita/ubah/{post:slug}', 'edit')
                            ->name('post.edit');
                        Route::put('/berita/ubah/{post:slug}', 'update')
                            ->name('post.update');
                        Route::delete('/berita/hapus/{post:slug}', 'destroy')
                            ->name('post.destroy');
                    });

                // Notification
                Route::controller(NotificationController::class)
                    ->group(function () {
                        Route::get('/notifikasi', 'index')
                            ->name('notification');
                        Route::put('/notifikasi', 'activation')
                            ->name('notification.activation');
                        Route::get('/notifikasi/tambah', 'create')
                            ->name('notification.create');
                        Route::post('/notifikasi/tambah', 'store')
                            ->name('notification.store');
                        Route::get('/notifikasi/ubah/{notification:slug}', 'edit')
                            ->name('notification.edit');
                        Route::put('/notifikasi/ubah/{notification:slug}', 'update')
                            ->name('notification.update');
                        Route::delete('/notifikasi/hapus/{notification:slug}', 'destroy')
                            ->name('notification.destroy');
                    });

                // Announcement
                Route::controller(AnnouncementController::class)
                    ->group(function () {
                        Route::get('/pengumuman',  'index')
                            ->name('announcement');
                        Route::put('/pengumuman/publis',  'publish')
                            ->name('announcement.publish');
                        Route::get('/pengumuman/tambah',  'create')
                            ->name('announcement.create');
                        Route::post('/pengumuman/tambah',  'store')
                            ->name('announcement.store');
                        Route::get('/pengumuman/ubah/{announcement:slug}',  'edit')
                            ->name('announcement.edit');
                        Route::put('/pengumuman/ubah/{announcement:slug}',  'update')
                            ->name('announcement.update');
                        Route::delete('/pengumuman/hapus/{announcement:slug}',  'destroy')
                            ->name('announcement.destroy');
                    });
                // Slider
                Route::controller(SliderController::class)
                    ->group(function () {
                        Route::get('/slider', 'index')
                            ->name('slider');
                        Route::get('/slider/tambah', 'create')
                            ->name('slider.create');
                        Route::post('/slider/tambah', 'store')
                            ->name('slider.store');
                        Route::get('/slider/ubah/{slider:id}', 'edit')
                            ->name('slider.edit');
                        Route::put('/slider/ubah/{slider:id}', 'update')
                            ->name('slider.update');
                        Route::delete('/slider/{slider:id}', 'destroy')
                            ->name('slider.destroy');
                    });

                // Priority
                Route::controller(PriorityController::class)
                    ->group(function () {
                        Route::put('/template_prioritas/data_sasaran/persetujuan/{priority_target:slug}',  'target_approval')
                            ->name('priority.target.approval');
                        Route::put('/template_prioritas/data_bulanan/persetujuan/{priority_monthly:slug}',  'monthly_approval')
                            ->name('priority.monthly.approval');
                        Route::put('/template_prioritas/data_tahunan/persetujuan/{priority_yearly:slug}',  'yearly_approval')
                            ->name('priority.yearly.approval');
                    });

                // SPM
                Route::controller(SpmController::class)
                    ->group(function () {
                        Route::put('/spm/data_sasaran/persetujuan/{spm_target:slug}',  'target_approval')
                            ->name('spm.target.approval');
                        Route::put('/spm/data_tahunan/persetujuan/{spm_yearly:slug}',  'yearly_approval')
                            ->name('spm.yearly.approval');
                    });
            });
        /*
    * End of Administrator Only
    */

        /*
    * Superadmin Only
    */
        Route::middleware('role:Superadmin')
            ->group(function () {
                // User
                Route::controller(UserController::class)
                    ->group(function () {
                        Route::get('/pengguna',  'index')
                            ->name('user');
                        Route::put('/pengguna/{user:id}',  'activation')
                            ->name('user.activation');
                        Route::get('/pengguna/tambah',  'create')
                            ->name('user.create');
                        Route::post('/pengguna/tambah',  'store')
                            ->name('user.store');
                        Route::get('/pengguna/ubah/{user:id}',  'edit')
                            ->name('user.edit');
                        Route::put('/pengguna/ubah/{user:id}',  'update')
                            ->name('user.update');
                        Route::put('/pengguna/hapus/{user:id}',  'destroy')
                            ->name('user.destroy');
                        Route::put('/pengguna/pulih/{id}',  'restore')
                            ->name('user.restore');
                        Route::put('/pengguna/lupa_kata_sandi/{user:id}',  'reset')
                            ->name('user.reset');
                    });
            });
        /*
    * End of Superadmin Only
    */

        /*
    * Administrator & Peninjau Only
    */
        Route::middleware('role:Administrator|Superadmin|Peninjau')
            ->group(function () {
                Route::controller(PriorityController::class)
                    ->group(function () {
                        Route::post('/template_prioritas/laporan/administrator',  'download_admin')
                            ->name('priority.report.admin');
                    });
                Route::controller(SPMController::class)
                    ->group(function () {
                        Route::post('/spm/laporan/administrator',  'download_admin')
                            ->name('spm.report.admin');
                    });
            });
        /*
    * End of Administrator & Peninjau Only
    */
    });
