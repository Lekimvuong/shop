<?php


namespace App\Providers;
use App\Http\View\Composers\ProductCatComposer;
use App\Http\View\Composers\ProductNewComposer;
use App\Http\View\Composers\ProductHotComposer;
use App\Http\View\Composers\SliderComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
 
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
 
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('productCat', ProductCatComposer::class);
        View::composer('slider', SliderComposer::class);
        View::composer('product_new', ProductNewComposer::class);
        View::composer('product_hot', ProductHotComposer::class);
    }
}