<?php

namespace App\Http\Controllers;
use App\Http\Services\ProductCat\ProductCatService;
use Illuminate\Http\Request;

class ProductCatController extends Controller
{
    protected $productCat;

    public function __construct(ProductCatService $productCat)
    {
        $this->productCat = $productCat;
    }

    public function index(Request $request, $id, $slug)
    {
        $productCat = $this->productCat->getId($id);
        $products = $this->productCat->getproduct($productCat);
        return view('product_cat.product_cat',['title' => 'Danh sách slider']);
        // $parentCat = $this->productCat->getParentCat($productCat);
}}
