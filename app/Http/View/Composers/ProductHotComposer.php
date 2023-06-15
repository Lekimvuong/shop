<?php


namespace App\Http\View\Composers;

use App\Models\Product;
use Illuminate\View\View;
class ProductHotComposer
{
    protected $users;
 
   
    public function __construct()
    {
    } 
 
    
    public function compose(View $view)
    {
        $products = Product::with('media')
        ->where('active', 1)
            ->select('id', 'name', 'price', 'price_sale')
            ->whereBetween('price_sale', [10000000, 30000000])
            ->limit(6)
            ->orderByDesc('id')
            ->get();
        $view->with('products', $products);
    }
}