<?php
namespace App\http\Services\Cart;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;

class CartService
{
    public function add($qty, $product_id)
    {
        if ($qty <= 0 || $product_id <= 0) {
            Session::flash('error', 'Số lượng hoặc sản phẩm không chính xác!');
            return false;
        }

        $carts = Session::get('carts');
        if (is_null($carts)) {
            Session::put('carts', [
                $product_id => $qty,
            ]);
            return true;
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
    public function create($request)           
    {
        $qty = (int)$request->input('num-product');
        $product_id = (int)$request->input('product_id');

        return $this->add($qty, $product_id);
    }
    public function update($request)
    {
        Session::put('carts', $request->input('num-product'));
        return true;
    }
    public function remove($id)
    {
        $carts = Session::get('carts');
        unset($carts[$id]);

        Session::put('carts', $carts);
        return true;
    }
    public function removeAll()
    {
        $carts = Session::get('carts');
        foreach ($carts as $key => $cart) {
        unset($carts[$key]);
        Session::put('carts', $carts);
        }
        return true;
    }

    public function addToCart($id)           
    {
        $qty = 1;
        $product_id = $id;

        return $this->add($qty, $product_id);
    }
}