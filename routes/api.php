<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HtmlPythonController;
Route::controller(Controller::class)->group(function () {
    Route::get('get_version', 'GetVersion');
});

Route::controller(ExampleController::class)->prefix('v1/example/')->group(function () {
    Route::get('data/{id}', 'GetData');
});

Route::prefix('/v1')->group(function () {
    Route::get('/post', [PostController::class, 'PostData']);
    Route::get('/post_text', [PostController::class, 'PostText']);
});

Route::prefix('/v1')->group(function () {
    Route::get('/post/list', [PostController::class, 'GetData']);
    Route::get('/post/show/{id}', [PostController::class, 'GetShow']);
});

Route::prefix('/v1/htmlPython')->group(function () {
    Route::get('list', [HtmlPythonController::class, 'list']);
    Route::get('show/{id}', [HtmlPythonController::class, 'show']);
    Route::post('post', [HtmlPythonController::class, 'post']);
    Route::patch('patch/{id}', [HtmlPythonController::class, 'patch']);
    Route::delete('delete/{id}', [HtmlPythonController::class, 'delete']);
});


