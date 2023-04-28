<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;


Route::prefix('auth')->group(function () {
    Route::get('/register', AuthController::class . "@registerView");
    Route::post('/register', AuthController::class . "@register")
        ->name('register.post');
    Route::get('/login', AuthController::class . "@loginView");
    Route::post('/login', AuthController::class . "@login")
        ->name('login.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/', PageController::class . '@pageView')
        ->name('page');
});

Route::post('/logout', AuthController::class . '@logout')
    ->name('logout');

Route::prefix('image')->group(function () {
    Route::post('upload', ImageController::class . '@upload')
        ->name('upload');
});
