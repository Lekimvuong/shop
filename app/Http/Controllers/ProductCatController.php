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
        $productCat = $this->productCat->filters([
            'id' => intval($id),
            'relations' => ['childrens'],
        ]);
        $categoryIds = $productCat->childrens->isNotEmpty() ? $productCat->childrens->pluck('id')->toArray() : [$id];
        $data['categoryIds'] = implode(',', $categoryIds);
        $parentCat = $this->productCat->getParentCat($productCat);
        $data['title'] = $productCat->name;
        $data['productCat'] = $productCat;
        $data['parentCat'] = $parentCat;
        return view('product_cat.index', $data);
    }

    public function getData(Request $request)
    {
        $categoryIds = trim($request->input('categoryIds'));
        $categoryIds = explode(',', $categoryIds);
        $sortBy = $request->input('url');
        $price_sort = $request->input('priceSort');
        $products = $this->product->applyFilters($sortBy,$price_sort, $categoryIds);
        $data['products'] = $products;
        $data['htmlProductLists'] = view('product_cat.product_list', $data)->render();
        return response()->json([
            'data' => $data,
        ]);
    }

}
