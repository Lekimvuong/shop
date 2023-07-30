<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Services\Cart\CartService;
use App\http\Services\Product\ProductService;
use Illuminate\Support\Facades\Session;
class CartController extends Controller
{


    protected $cartService;
    protected $product;


    public function __construct(CartService $cartService, ProductService $product)
    {
        $this->cartService = $cartService;
        $this->product = $product;
    }
    public function index(Request $request)
    {
        $result = $this->cartService->create($request);
        if ($result == false) {
            return redirect()->back();
        }
        return redirect()->route('cart.show');
    }
    public function show()
    {
        $data['products'] = $this->product->getProduct();
        $data['title'] = 'Giỏ hàng';
        $data['carts'] = Session::get('carts');
        return view('cart.cart', $data);
    }

    public function update(Request $request)
    {
        $this->cartService->update($request);
        return redirect()->route('cart.show');
    }
    public function remove($id = 0)
    {
        $this->cartService->remove($id);
        return redirect()->route('cart.show');
    }
    public function removeAll()
    {
        $this->cartService->removeAll();
        return redirect()->route('cart.show');
    }
    public function addToCart($id)
    {
        $this->cartService->addToCart($id);
        return redirect()->back();
    }
}
