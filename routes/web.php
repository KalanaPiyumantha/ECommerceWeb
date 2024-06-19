<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('user.home');
    })->name('dashboard');
    Route::get('/admin/home', function () {
        return view('admin.home');
    })->name('admin.home');
});

Route::get('/redirect', [HomeController::class, 'redirect'])->middleware('auth');
Route::get('/', [HomeController::class, 'index']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
