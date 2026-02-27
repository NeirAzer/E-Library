<?php

use App\Http\Controllers\HallController;
use App\Http\Controllers\loginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage', [
        'title' => 'Homepage'
    ]);
});
Route::get('/about', function () {
    return view('about', [
        'title' => 'About'
    ]);
});
Route::get('/hall', [HallController::class, 'index']);
Route::get('/hall/book/{book:slug}', [HallController::class, 'singleBook']);

Route::get('/login', [loginController::class, 'login']);
Route::post('/login', [loginController::class, 'authenticate']);
Route::get('/register', [loginController::class, 'register']);
Route::post('/register', [loginController::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard');
});