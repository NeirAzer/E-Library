<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\categoryController;
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

    Route::get('category', [categoryController::class, 'index']);
    Route::get('category/create', [categoryController::class, 'create']);
    Route::get('category/{category:slug}/edit', [categoryController::class, 'edit']);
    Route::post('category', [categoryController::class, 'store']);
    Route::put('category/{category:slug}', [categoryController::class, 'update']);
    Route::delete('category/{category:slug}', [categoryController::class, 'destroy']);
    
    Route::resource('author', AuthorController::class);
});