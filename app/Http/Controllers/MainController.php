<?php

namespace App\Http\Controllers;
use App\Http\Services\Product\ProductClientService;
use App\Http\Services\ProductCat\ProductCatService;
class MainController extends Controller
{
    protected $product;
    protected $productCat;
    public function __construct( ProductCatService $productCat, ProductClientService $product)
    {
        $this->product = $product;
        $this->productCat = $productCat;
    }

    public function index()
    {
        return view('home', [
            'title' => 'Vượng Store | Mua hàng online giá tốt',
            'productCats' => $this->productCat->show(),
            'products' =>$this->product->get(),
            'allProductCats' => $this->productCat->getAllCat(),
        ]);
    }
}



