<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\PostCatController;
use App\Http\Controllers\Admin\ProductController;
use \App\Http\Controllers\Admin\Users\Logincontroller;
use \App\Http\Controllers\Admin\UploadController;

Route::get('admin/users/login', [LoginController::class, 'index'])->name('login');
Route::post('admin/users/login/store', [LoginController::class, 'store']);

// main
Route::middleware(['auth'])->group(function () {
    Route::get('admin/users/logout', [LoginController::class, 'logout'])->name('logout');
    Route::prefix('admin')->group(function () {
        Route::get('main', [MainController::class, 'index']);
        Route::get('/', [MainController::class, 'index'])->name('admin');

        //PostCat
        Route::prefix('postCats')->group(function () {
            Route::get('add', [PostCatController::class, 'create'])->name('postCats.add');
            Route::post('add', [PostCatController::class, 'store']);
            Route::get('list-posts', [PostCatController::class, 'index'])->name('postCats.list-posts');
            Route::get('edit/{postCat}', [PostCatController::class, 'show'])->name('postCats.edit');
            Route::post('edit/{postCat}', [PostCatController::class, 'update'])->name('postCats.update');
            Route::delete('destroy', [PostCatController::class, 'destroy'])->name('postCats.delete');
        });
        //Products
        Route::prefix('Products')->group(function () {
            Route::get('add', [ProductController::class, 'create'])->name('products.add');
            Route::post('add', [ProductController::class, 'store'])->name('products.add.store');
            Route::get('list', [ProductController::class, 'index'])->name('products.list');
        });
         //Upload
         Route::post('upload/services', [UploadController::class, 'store'])->name('Upload.files');
    });
});