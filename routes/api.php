<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HtmlPythonController;
use App\Http\Controllers\AreaController;
Route::controller(Controller::class)->group(function () {
    Route::get('get_version', 'GetVersion');
});

Route::controller(ExampleController::class)->prefix('v1/example/')->group(function () {
    Route::get('data/{id}', 'GetData');
});

Route::prefix('/v1/automatic')->group(function () {
    Route::get('/post', [PostController::class, 'PostData']);
    Route::get('/post_text', [PostController::class, 'PostText']);
    Route::post('/test', [PostController::class, 'test']);
});

Route::prefix('/v1/post')->group(function () {
    Route::get('/list', [PostController::class, 'GetData']);
    Route::get('/show/{id}', [PostController::class, 'GetShow']);
    Route::get('/js', [PostController::class, 'js']);
});

Route::prefix('/v1/htmlPython')->group(function () {
    Route::get('list', [HtmlPythonController::class, 'list']);
    Route::get('show/{id}', [HtmlPythonController::class, 'show']);
    Route::post('post', [HtmlPythonController::class, 'post']);
    Route::patch('patch/{id}', [HtmlPythonController::class, 'patch']);
    Route::delete('delete/{id}', [HtmlPythonController::class, 'delete']);
});



Route::prefix('/v1/area')->group(function () {
    Route::get('/list', [AreaController::class, 'list']);
    Route::get('/show/{id}', [AreaController::class, 'show']);
});
Route::prefix('/v1/user')->group(function () {
    Route::get('/', [PostController::class, 'user']);
    Route::get('/token', [PostController::class, 'token']);
});







