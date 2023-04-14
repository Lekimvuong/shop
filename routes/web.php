<?php

use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\Users\Logincontroller;

Route::get('admin/users/login', [LoginController::class, 'index'])->name('login');
Route::post('admin/users/login/store', [LoginController::class, 'store']);

// Bảo vệ khi chưa đăng nhập
Route::middleware(['auth'])->group(function () {
    Route::get('admin/users/logout', [LoginController::class, 'logout'])->name('logout');
    Route::prefix('admin')->group(function () {
        Route::get('main', [MainController::class, 'index']);
        Route::get('/', [MainController::class, 'index'])->name('admin');

        Route::prefix('posts')->group(function () {
            Route::get('add', [PostController::class, 'create'])->name('posts.add');
            Route::post('add', [PostController::class, 'store']);
            Route::get('list-posts', [PostController::class, 'index'])->name('posts.list-posts');
            Route::get('edit/{post}', [PostController::class, 'show'])->name('posts.edit');
            Route::delete('destroy', [PostController::class, 'destroy'])->name('posts.delete');
        });
    });

});

// t chưa sưa
// T ví dụ nha,. Kiểu kiểu rứa. Nhớ config lại thanh menu nhé
