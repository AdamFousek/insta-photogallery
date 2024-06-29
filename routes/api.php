<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/test-me", function () {
    return 'Hello from Laravel!';
});

Route::group(['prefix' => 'validate'], function () {
    Route::post('/email', \App\Http\Controllers\Api\Validation\EmailValidationController::class)->name('validate.email');
    Route::post('/username', \App\Http\Controllers\Api\Validation\UsernameValidationController::class)->name('validate.username');
});

Route::group(['prefix' => 'user'], function () {
    Route::put('/register', \App\Http\Controllers\Api\User\RegisterController::class);
});
