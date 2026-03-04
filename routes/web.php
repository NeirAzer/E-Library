<?php

use App\Http\Controllers\HallController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\loginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [homeController::class, 'index']);

Route::get('/about', function () {
    return view('about', [
        'title' => 'About'
    ]);
});

Route::get('/hall', [HallController::class, 'index']);
Route::get('/hall/book/{book:slug}', [HallController::class, 'singleBook']);

Route::get('/login', [loginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [loginController::class, 'authenticate'])->middleware('guest');
Route::get('/register', [loginController::class, 'register'])->middleware('guest');
Route::post('/register', [loginController::class, 'store'])->middleware('guest');

Route::post('/logout', [loginController::class, 'logout'])->middleware('auth');

Route::prefix('dashboard')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/', function () {
        return view('dashboard.dashboard', [
            'title' => 'Dashboard'
        ]);
    });
});