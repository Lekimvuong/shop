<?php


namespace App\Http\View\Composers;
use Illuminate\View\View;
use App\http\Services\Product\ProductService;
use Illuminate\Support\Facades\Session;
class CartComposer
{
    protected $users;
    protected $product;
   
    public function __construct( ProductService $product)
    {
        $this->product = $product;
    } 
 
    
    public function compose(View $view)
    {
        $products = $this->product->getProduct();
        $carts = Session::get('carts');
        $view->with('carts', $carts);
        $view->with('products', $products);
    }
}