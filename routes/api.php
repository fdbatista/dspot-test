<?php

use App\Http\Controllers\FriendsController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\EnsureCityIsValid;
use App\Http\Middleware\EnsureProfileIsUnique;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('profiles')->controller(ProfileController::class)->group(function () {
        Route::get('/', 'all');
        Route::get('/{id}', 'find');

        Route::middleware([EnsureCityIsValid::class, EnsureProfileIsUnique::class])->group(function () {
            Route::put('/', 'update');
            Route::post('/', 'create');
        });
    });

    Route::prefix('friends')->controller(FriendsController::class)->group(function () {
        Route::get('/{id}', 'findFriends');
        Route::get('/path/{origin}/{destination}', 'findShorterPath');
    });
});
