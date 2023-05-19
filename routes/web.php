<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\PostCatController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\Users\Logincontroller;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\ProductCatController;

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
            Route::get('list', [PostCatController::class, 'index'])->name('postCats.list');
            Route::get('edit/{postCat}', [PostCatController::class, 'show'])->name('postCats.edit');
            Route::post('edit/{postCat}', [PostCatController::class, 'update'])->name('postCats.update');
            Route::delete('destroy', [PostCatController::class, 'destroy'])->name('postCats.delete');
        });
        //productCat
        Route::prefix('productCat')->group(function () {
            Route::get('add', [ProductCatController::class, 'create'])->name('productCat.add');
            Route::post('add', [ProductCatController::class, 'store']);
            Route::get('list', [ProductCatController::class, 'index'])->name('productCat.list');
            Route::delete('destroy', [ProductCatController::class, 'destroy'])->name('productCat.delete');
            Route::get('edit/{productCat}', [ProductCatController::class, 'show'])->name('productCat.show');
            Route::post('edit/{productCat}', [ProductCatController::class, 'update'])->name('productCat.update');
        });
        //Products
        Route::prefix('Products')->group(function () {
            Route::get('add', [ProductController::class, 'create'])->name('products.add');
            Route::post('add', [ProductController::class, 'store'])->name('products.add.store');
            Route::get('list', [ProductController::class, 'index'])->name('products.list');
            Route::get('edit/{product}', [ProductController::class, 'show'])->name('products.show');
            Route::post('edit/{product}', [ProductController::class, 'update'])->name('products.update');
            Route::delete('destroy', [ProductController::class, 'destroy'])->name('products.delete');
        });
         //Upload
         Route::post('upload/services', [UploadController::class, 'store'])->name('Upload.files');
         Route::post('upload/services', [UploadController::class, 'insertImages'])->name('Upload.images');
         Route::get('upload/services/add', [UploadController::class, 'create'])->name('Upload.add');
         Route::post('upload/services/add', [UploadController::class, 'multiStore'])->name('Upload.multifiles');
         Route::get('upload/services/list', [UploadController::class, 'index'])->name('Upload.list');
         Route::delete('upload/services/delete', [UploadController::class, 'delete'])->name('Upload.delete');
    });
});