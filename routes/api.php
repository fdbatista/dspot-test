<?php

use App\Http\Controllers\EarningController;
use App\Http\Controllers\JwtController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\JwtAuth;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')
    ->group(function () {
        Route::prefix('jwt')
            ->controller(JwtController::class)
            ->group(function () {
                Route::get('/', 'renewJwt');
            });

        Route::prefix('users')
            ->middleware([JwtAuth::class])
            ->controller(UserController::class)->group(function () {
                Route::prefix('consultants')->group(function () {
                    Route::get('/', 'getConsultants');
                });
            });

        Route::prefix('earnings')
            ->middleware([JwtAuth::class])
            ->controller(EarningController::class)->group(function () {
                Route::get('/', 'getEarnings');
                Route::get('/fixed-cost-avg', 'getFixedCostAverage');
                Route::get('/percent', 'getPercentsByConsultant');
            });
    });

