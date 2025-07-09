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
    Route::get('/dashboard/home', [DashboardController::class, 'index'])->name('dashboard.home');
    Route::get('/dashboard/request', [RequestController::class, 'index'])->name('dashboard.request');
    Route::post('/dashboard/request/store', [RequestController::class, 'store'])->name('dashboard.request.store');
    Route::get('/dashboard/request/edit/{id}', [RequestController::class, 'edit'])->name('dashboard.request.edit');
    Route::put('/dashboard/request/update/{id}', [RequestController::class, 'updateRequest'])->name('dashboard.request.update');
    Route::get('/dashboard/blogs', [BlogController::class, 'index'])->name('dashboard.blog');
    Route::delete('/request/destroy/{id}', [RequestController::class, 'destroy'])->name('dashboard.request.destroy');
    Route::patch('/request/accept/{id}', [RequestController::class, 'accept'])->name('dashboard.request.accept');
    Route::get('/dashboard/profile', [ProfileController::class, 'index'])->name('dashboard.profile');
    Route::post('/dashboard/profile/update', [ProfileController::class, 'update'])->name('dashboard.profile.update');
});

require __DIR__ . '/auth.php';
