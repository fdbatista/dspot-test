<?php

use App\Http\Controllers\FriendsController;
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

        Route::controller(FriendsController::class)->group(function () {
            Route::get('/{profileId}/friends', 'findFriends');
            Route::get('/{profileId}/path/{friendId}', 'findShorterPath');
        });
    });
});
