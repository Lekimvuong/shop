<?php
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\PostCatController;
use App\Http\Controllers\Admin\ProductCatController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\Users\Logincontroller;
use Illuminate\Support\Facades\Route;

Route::get('admin/users/login', [LoginController::class, 'index'])->name('login');
Route::post('admin/users/login/store', [LoginController::class, 'store']);

// main
Route::middleware(['auth'])->group(function () {
    Route::get('admin/users/logout', [LoginController::class, 'logout'])->name('logout');
    Route::prefix('admin')->group(function () {
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
        //Sliders
        Route::prefix('Sliders')->group(function () {
            Route::get('add', [SliderController::class, 'create'])->name('slider.add');
            Route::post('add', [SliderController::class, 'store'])->name('slider.add.store');
            Route::get('list', [SliderController::class, 'index'])->name('slider.list');
            Route::get('edit/{slider}', [SliderController::class, 'show'])->name('slider.show');
            Route::post('edit/{slider}', [SliderController::class, 'update'])->name('slider.update');
            Route::delete('destroy', [SliderController::class, 'destroy'])->name('slider.delete');
        });
        //Upload
        Route::post('upload/services', [UploadController::class, 'insertImages'])->name('Upload.images');
        Route::get('upload/services/add', [UploadController::class, 'create'])->name('Upload.add');
        Route::post('upload/add', [UploadController::class, 'store'])->name('Update.image');
        Route::post('upload/services/add', [UploadController::class, 'multiStore'])->name('Upload.multifiles');
        Route::get('upload/services/list', [UploadController::class, 'index'])->name('Upload.list');
        Route::delete('upload/services/delete', [UploadController::class, 'delete'])->name('Upload.delete');
        Route::delete('upload/services/deleteOld', [UploadController::class, 'deleteOld']);
        Route::get('upload/services/edit/{media}', [UploadController::class, 'show'])->name('Upload.edit');
        Route::post('upload/services/edit/{media}', [UploadController::class, 'update'])->name('Upload.update');
        Route::delete('upload/services/destroy', [UploadController::class, 'destroy'])->name('Upload.destroy');
    });
});

Route::get('/', [App\Http\Controllers\MainController::class, 'index'])->name('main');
#Product
Route::prefix('danh-muc')->group(function () {
    Route::get('/{id}-{slug}.html', [App\Http\Controllers\ProductCatController::class, 'index'])->name('productCat.index');
    Route::get('getData', [App\Http\Controllers\ProductCatController::class, 'getData'])->name('productCat.getData');
});
Route::get('san-pham/{id}-{slug}.html', [App\Http\Controllers\ProductController::class, 'index'])->name('product.index');
Route::post('add-cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::get('carts', [App\Http\Controllers\CartController::class, 'show'])->name('cart.show');
Route::post('update-cart', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::get('carts/delete/{id}', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::get('carts/delete-all', [App\Http\Controllers\CartController::class, 'removeAll'])->name('cart.removeAll');

Route::get('add-cart/{id}', [App\Http\Controllers\CartController::class, 'addToCart'])->name('cart.addToCart');