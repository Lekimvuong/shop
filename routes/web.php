<?php

use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\Users\Logincontroller;

Route::get('admin/users/login', [LoginController::class, 'index'])->name('login');
Route::post('admin/users/login/store', [LoginController::class, 'store']);

// Bảo vệ khi chưa đăng nhập

Route::middleware(['auth'])->group(function(){
    Route::get('admin/main', [MainController::class, 'index']);
    Route::get('admin', [MainController::class, 'index'])->name('admin');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('main', [MainController::class, 'index']);
        Route::get('/', [MainController::class, 'index'])->name('admin');
        Route::prefix('menus')->group(function () {
            
            //điều hướng
            Route::get('add', [MenuController::class, 'create']);
        });
    });

});

