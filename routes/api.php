<?php

use App\Http\Controllers\FriendsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')
    ->group(function () {
        Route::prefix('profile')->controller(ProfileController::class)->group(function () {
            Route::get('/', 'all');
            Route::get('/{id}', 'find');
            Route::put('/', 'update');
            Route::post('/', 'create');
        });

        Route::prefix('friends')->controller(FriendsController::class)->group(function () {
            Route::get('/{id}', 'findFriends');
            Route::get('/path/{origin}/{destination}', 'findShorterPath');
        });
    });
