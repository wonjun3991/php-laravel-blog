<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('posts')->name('posts.')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::post('/', [PostController::class, 'store'])->name('store');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::get('/{post}/edit', [PostController::class, 'edit'])->name('edit');
        Route::put('/{post}', [PostController::class, 'update'])->name('update');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('destroy');
    });

    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/{post}', [PostController::class, 'show'])->name('show');

    Route::prefix('{post}/comments')->name('comments.')->group(function () {
        Route::middleware('auth')->post('/', [CommentController::class, 'store'])->name('store');
    });
});

Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('login', [AuthController::class, 'loginForm'])->name('login-form');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::get('register', [AuthController::class, 'registerForm'])->name('register-form');
    Route::post('register', [AuthController::class, 'register'])->name('register');

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
