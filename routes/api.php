<?php

use App\Http\Controllers\FriendController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\EnsureCityIsValid;
use App\Http\Middleware\EnsureProfileIsUnique;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('profiles')->group(function () {
        Route::controller(ProfileController::class)->group(function () {
            Route::get('/', 'all');

            Route::middleware([EnsureCityIsValid::class, EnsureProfileIsUnique::class])->group(function () {
                Route::post('/', 'create');
                Route::put('/', 'update');
            });

            Route::get('/{id}', 'find');
        });

        Route::controller(FriendController::class)->group(function () {
            Route::get('/{id}/friends', 'findFriends');
            Route::get('/{id}/path/{friendId}', 'findShorterPath');
        });
    });
});
