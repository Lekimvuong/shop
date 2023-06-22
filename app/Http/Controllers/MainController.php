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
        $data['title']= 'Vượng Store | Mua hàng online giá tốt';
        $data['productCats' ] = $this->productCat->getFatherCat();
        $data['products'] = $this->product->get();
        $data['allProductCats' ] = $this->productCat->getAllCat();
        return view('home', $data);
    }
}



