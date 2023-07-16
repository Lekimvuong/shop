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
        $data['fatherCats' ] = $this->productCat->filters(['parent_id' => 0, 'active' => 1]);
        $data['products'] = $this->product->get();
        $data['allProductCats' ] = $this->productCat->filters(['active' => 1]);
        return view('home.home', $data);
    }
}



