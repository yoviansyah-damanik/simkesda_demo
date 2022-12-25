<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::middleware('auth:sanctum')
// ->get('/provinces', [ApiController::class, 'provinces']);
// ->group(function () {
// });

Route::get('/provinces', [ApiController::class, 'provinces']);
// Route::get('/province/{province:id}', [ApiController::class, 'getProvince']);
Route::get('/regencies', [ApiController::class, 'regencies']);
Route::get('/districts', [ApiController::class, 'districts']);
Route::get('/villages', [ApiController::class, 'villages']);
Route::get('/priority_data', [ApiController::class, 'priority_data']);
Route::get('/spm_data', [ApiController::class, 'spm_data']);
