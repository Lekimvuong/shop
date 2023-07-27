<?php
namespace App\http\Services\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
class CartService
{
    public function create($request)          
    {
        $qty = (int)$request->input('num-product');
        $product_id = (int)$request->input('product_id');
        if ($qty <= 0 || $product_id <= 0) {
            Session::flash('error', 'Số lượng hoặc sản phẩm không chính xác!');
            return false;
        }
        
        $carts = Session::get('carts');
        if (is_null($carts)) {
            Session::put('carts', [
                $product_id => $qty,
            ]);
           
        }
        $exists = Arr::exists($carts, $product_id);
        if ($exists) {
            $carts[$product_id] = $carts[$product_id] + $qty;
            Session::put('carts', $carts);
            return true;
        }
        $carts[$product_id] = $qty;
        Session::put('carts', $carts);
        return true;
    }


}