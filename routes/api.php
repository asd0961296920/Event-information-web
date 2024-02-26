<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ExampleController;

Route::controller(Controller::class)->group(function () {
    Route::get('get_version', 'GetVersion');
});

Route::controller(ExampleController::class)->prefix('v1/example/')->group(function () {
    Route::get('data/{id}', 'GetData');
});