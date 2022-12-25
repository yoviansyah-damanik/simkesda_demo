<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\ChartController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\HomepageController;
use App\Http\Controllers\Frontend\AnnouncementController;
use App\Http\Controllers\Frontend\PuskesmasProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
*   Front End Routes
*/

Route::get('/', [HomepageController::class, 'index'])
    ->name('homepage');
Route::get('/berita', [PostController::class, 'index'])
    ->name('post');
Route::get('/berita/{post:slug}', [PostController::class, 'show'])
    ->name('post.show');
Route::get('/pengumuman', [AnnouncementController::class, 'index'])
    ->name('announcement');
Route::get('/pengumuman/{announcement:slug}', [AnnouncementController::class, 'show'])
    ->name('announcement.show');
Route::get('/profil_puskesmas', [PuskesmasProfileController::class, 'index'])
    ->name('puskesmas');
Route::get('/profil_puskesmas/{puskesmas_profile:slug}', [PuskesmasProfileController::class, 'show'])
    ->name('puskesmas.show');
Route::get('/tentang', [AboutController::class, 'index'])
    ->name('about');
Route::get('/grafik_data', [ChartController::class, 'index'])
    ->name('chart');
Route::get('/grafik_data/{year}/{chart}', [ChartController::class, 'show'])
    ->name('chart.show');
/*
*   End of Front End Routes
*/

include('backend.php'); // Back End Routes
include('auth.php'); // Authentication Routes
