<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/blogs/{id}', [BlogController::class, 'detail'])->name('blogs');

Route::get('/test', function () {
    return 'Laravel is working';
});

Route::middleware('auth')->group(function () {
    Route::get('/dsboard/home', [DashboardController::class, 'index'])->name('dashboard.home');
    Route::get('/dsboard/request', [RequestController::class, 'index'])->name('dashboard.request');
    Route::post('/dsboard/request/store', [RequestController::class, 'store'])->name('dashboard.request.store');
    Route::get('/dsboard/blogs', [BlogController::class, 'index'])->name('dashboard.blog');
    Route::post('/request/destroy/{id}', [RequestController::class, 'destroy'])->name('dashboard.request.destroy');
    Route::post('/request/update/{id}', [RequestController::class, 'update'])->name('dashboard.request.update');
    Route::get('/dsboard/profile', [ProfileController::class, 'index'])->name('dashboard.profile');
    Route::post('/dsboard/profile/update', [ProfileController::class, 'update'])->name('dashboard.profile.update');
});

require __DIR__.'/auth.php';
