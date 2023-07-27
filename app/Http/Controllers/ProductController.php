<?php

namespace App\Http\Controllers;
use App\http\Services\Product\ProductService;
use App\Http\Services\ProductCat\ProductCatService;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected $product;
    protected $productCat;
  

    public function __construct(ProductService $product, ProductCatService $productCat)
    {
        $this->product = $product;
        $this->productCat = $productCat;
    }

    public function index(Request $request, $id, $slug)
    {
        $product = $this->product->filters([
            'id' => intval($id),
            'status'=> 1,
            'relations' => ['product_cat'],
        ]);
        $allproducts = $this->product->filters([
            'status'=> 1,
            'relations' => ['product_cat'],
            'orderBy'=> 'name',
            'perPage' => 10
        ]);
        $productCat = $product->product_cat;
        $parentCat = $this->productCat->getParentCat($productCat);
        $data['product'] = $product;
        $data['title'] =$product->name;
        $data['productCat'] = $productCat;
        $data['parentCat'] = $parentCat;
        $data['products'] = $allproducts;
        $data['Images'] = $product->media;
        return view('product.detail_product', $data);
    }

}
