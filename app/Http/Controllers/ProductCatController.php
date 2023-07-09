<?php

namespace App\Http\Controllers;
use App\Http\Services\ProductCat\ProductCatService;
use App\http\Services\Product\ProductService;
use Illuminate\Http\Request;

class ProductCatController extends Controller
{
    protected $productCat;
    protected $product;

    public function __construct(ProductCatService $productCat, ProductService $product)
    {
        $this->productCat = $productCat;
        $this->product = $product;
    }
    public function index(Request $request, $id, $slug)
    {
        $productCat = $this->productCat->getId($id); //Lấy danh mục sản phẩm dựa trên id truyền vào //Lấy sản phẩm dựa trên danh mục sản phẩm
        $childrentCat = $this->productCat->getChildrenCat($productCat); // lấy danh mục sản phẩm con
        if (isset($request->sort_by)) {
            $sortBy = $request->sort_by;
            if ($sortBy == 'a-z') {
                $products = $this->productCat->getProduct($productCat)->orderBy('name')->paginate(20)->appends(request()->query());
            } elseif ($sortBy == 'z-a') {
                $products = $this->productCat->getProduct($productCat)->orderByDesc('name')->paginate(20)->appends(request()->query());
            } elseif ($sortBy == 'asc') {
                $products = $this->productCat->getProduct($productCat)->orderBy('price_sale')->paginate(20)->appends(request()->query());
            } elseif ($sortBy == 'desc') {
                $products = $this->productCat->getProduct($productCat)->orderByDesc('price_sale')->paginate(20)->appends(request()->query());
            }
        } else {
            $products = $this->productCat->getProduct($productCat)->paginate(20)->appends(request()->query());
        }
        $data['title'] = $productCat->name;
        $data['products'] = $products;
        $data['productCat'] = $productCat;
        $data['childrenCat'] = $childrentCat;
        return view('product_cat.product_cat', $data);
       
}}
