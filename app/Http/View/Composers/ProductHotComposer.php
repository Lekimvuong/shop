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
        $products = Product::where('active', 1)
            ->select('id', 'name', 'price', 'price_sale')
            ->limit(8)
            ->orderByDesc('id')
            ->get();
        $view->with('products', $products);
    }
}