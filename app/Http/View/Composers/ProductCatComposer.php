<?php


namespace App\Http\View\Composers;

use App\Models\ProductCat;
use Illuminate\View\View;
 
class ProductCatComposer
{
    protected $users;
 
   
    public function __construct()
    {
    } 
 
    
    public function compose(View $view)
    {
        $productCat = productCat::select('id', 'name', 'parent_id')->where('active', 1)->get();
        $view->with('productCat', $productCat);
    }
}