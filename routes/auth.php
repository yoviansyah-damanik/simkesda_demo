<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;

Route::middleware('guest')
    ->group(function () {
        Route::get('/login', [AuthController::class, 'index'])
            ->name('login');

        Route::post('/login', [AuthController::class, 'authenticate'])
            ->name('login.auth');

        Route::get('/lupa-password', [ForgotPasswordController::class, 'index'])
            ->name('password.forgot');

        Route::post('/lupa-password', [ForgotPasswordController::class, 'check'])
            ->name('password.check');

        Route::get('/lupa-password/{token}', [ForgotPasswordController::class, 'reset'])
            ->name('password.reset');

        Route::post('/lupa-password/{token}', [ForgotPasswordController::class, 'update'])
            ->name('password.update');
    });

Route::post('/logout', [AuthController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
