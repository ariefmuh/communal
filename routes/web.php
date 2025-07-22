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

    // Dashboard Request Routes
    Route::get('/dashboard/request', [RequestController::class, 'index'])->name('dashboard.request');
    Route::post('/dashboard/request/store', [RequestController::class, 'store'])->name('dashboard.request.store');
    Route::get('/dashboard/request/edit/{id}', [RequestController::class, 'edit'])->name('dashboard.request.edit');
    Route::put('/dashboard/request/update/{id}', [RequestController::class, 'updateRequest'])->name('dashboard.request.update');
    Route::delete('/request/destroy/{id}', [RequestController::class, 'destroy'])->name('dashboard.request.destroy');
    Route::patch('/request/accept/{id}', [RequestController::class, 'accept'])->name('dashboard.request.accept');
    Route::patch('/request/reject/{id}', [RequestController::class, 'reject'])->name('dashboard.request.reject');

    // Dashboard Blog Routes
    Route::get('/dashboard/blogs', [BlogController::class, 'index'])->name('dashboard.blog');
    Route::get('/dashboard/blogs/create', [BlogController::class, 'create'])->name('dashboard.blog.create');
    Route::post('/dashboard/blogs/store', [BlogController::class, 'store'])->name('dashboard.blog.store');
    Route::get('/dashboard/blogs/edit/{id}', [BlogController::class, 'edit'])->name('dashboard.blog.edit');
    Route::post('/dashboard/blogs/update/{id}', [BlogController::class, 'update'])->name('dashboard.blog.update');
    Route::delete('/dashboard/blogs/destroy/{id}', [BlogController::class, 'destroy'])->name('dashboard.blog.destroy');
    Route::get('/dashboard/blogs/detail/{id}', [BlogController::class, 'detail'])->name('dashboard.blog.detail');
    Route::get('/dashboard/blogs/preview/{id}', [BlogController::class, 'preview'])->name('dashboard.blog.preview');
    Route::get('/dashboard/blogs/preview/{id}/edit', [BlogController::class, 'editPreview'])->name('dashboard.blog.preview.edit');
    Route::put('/dashboard/blogs/preview/{id}/update', [BlogController::class, 'updatePreview'])->name('dashboard.blog.preview.update');


    Route::get('/dashboard/profile', [ProfileController::class, 'index'])->name('dashboard.profile');
    Route::post('/dashboard/profile/update', [ProfileController::class, 'update'])->name('dashboard.profile.update');
});

require __DIR__ . '/auth.php';
