<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\CommunityProgramController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\QuizController;
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
Route::get('/blogs', [BlogController::class, 'view'])->name('blogs');
Route::get('/blogs/{id}', [BlogController::class, 'detail'])->name('blogs.detail');

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

    // Dashboard Homepage
    Route::get('/dashboard/homepage', [HomepageController::class, 'index'])->name('dashboard.homepage');
    Route::post('/dashboard/homepage/update', [HomepageController::class, 'update'])->name('dashboard.homepage.update');
    Route::post('/dashboard/homepage/store', [HomepageController::class, 'store'])->name('dashboard.homepage.store');

    Route::get('/dashboard/profile', [ProfileController::class, 'index'])->name('dashboard.profile');
    Route::post('/dashboard/profile/update', [ProfileController::class, 'update'])->name('dashboard.profile.update');

    // Community Programs
    Route::get('/dashboard/programs', [CommunityProgramController::class, 'index'])->name('dashboard.programs');
    Route::get('/dashboard/programs/create', [CommunityProgramController::class, 'create'])->name('dashboard.programs.create');
    Route::post('/dashboard/programs', [CommunityProgramController::class, 'store'])->name('dashboard.programs.store');
    Route::get('/dashboard/programs/{id}', [CommunityProgramController::class, 'show'])->name('dashboard.programs.show');
    Route::post('/dashboard/programs/{id}/approve', [CommunityProgramController::class, 'approve'])->name('dashboard.programs.approve');
    Route::post('/dashboard/programs/{id}/reject', [CommunityProgramController::class, 'reject'])->name('dashboard.programs.reject');

    // Team Members
    Route::get('/dashboard/members', [TeamMemberController::class, 'index'])->name('dashboard.members');
    Route::get('/dashboard/members/create', [TeamMemberController::class, 'create'])->name('dashboard.members.create');
    Route::get('/dashboard/members/{id}', [TeamMemberController::class, 'show'])->name('dashboard.members.show');
    Route::post('/dashboard/members', [TeamMemberController::class, 'store'])->name('dashboard.members.store');
    Route::delete('/dashboard/members/{id}', [TeamMemberController::class, 'destroy'])->name('dashboard.members.destroy');

    // Quizzes
    Route::get('/dashboard/quizzes', [QuizController::class, 'index'])->name('dashboard.quizzes');
    Route::get('/dashboard/quizzes/create', [QuizController::class, 'create'])->name('dashboard.quizzes.create');
    Route::post('/dashboard/quizzes', [QuizController::class, 'store'])->name('dashboard.quizzes.store');
    Route::get('/dashboard/quizzes/{id}', [QuizController::class, 'show'])->name('dashboard.quizzes.show');
    Route::get('/dashboard/quizzes/{id}/edit', [QuizController::class, 'edit'])->name('dashboard.quizzes.edit');
    Route::put('/dashboard/quizzes/{id}', [QuizController::class, 'update'])->name('dashboard.quizzes.update');
    Route::delete('/dashboard/quizzes/{id}', [QuizController::class, 'destroy'])->name('dashboard.quizzes.destroy');
    Route::post('/dashboard/quizzes/{id}/request', [QuizController::class, 'requestQuiz'])->name('dashboard.quizzes.request');
    Route::get('/dashboard/quizzes/{id}/export', [QuizController::class, 'export'])->name('dashboard.quizzes.export');


    // Gallery
    Route::get('/dashboard/gallery', [GalleryController::class, 'index'])->name('dashboard.gallery');
    Route::get('/dashboard/gallery/create', [GalleryController::class, 'create'])->name('dashboard.gallery.create');
    Route::get('/dashboard/gallery/{id}', [GalleryController::class, 'show'])->name('dashboard.gallery.show');
    Route::post('/dashboard/gallery', [GalleryController::class, 'store'])->name('dashboard.gallery.store');
    Route::delete('/dashboard/gallery/{id}', [GalleryController::class, 'destroy'])->name('dashboard.gallery.destroy');
});

require __DIR__ . '/auth.php';
