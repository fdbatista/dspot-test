<?php

use App\Http\Controllers\MySwaggerController;
use Illuminate\Support\Facades\Route;
use Mezatsong\SwaggerDocs\Http\Controllers\SwaggerController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('doc')->group(function () {
    Route::get('/', [MySwaggerController::class, 'index']);
    Route::get('json', [SwaggerController::class, 'documentation']);
});
