<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\PostController;
Route::controller(Controller::class)->group(function () {
    Route::get('get_version', 'GetVersion');
});

Route::controller(ExampleController::class)->prefix('v1/example/')->group(function () {
    Route::get('data/{id}', 'GetData');
});

Route::prefix('/v1')->group(function () {
    Route::get('/post', [PostController::class, 'PostData']);
});





