<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Services\ProductCat\ProductCatService;
use App\http\Services\Product\ProductService;
use App\http\Services\Upload\UploadService;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    protected $productService;
    protected $productCatService;
    protected $uploadService;
    public function __construct(ProductService $productService, ProductCatService $productCatService, UploadService $uploadService)
    {
        $this->productService = $productService;
        $this->productCatService = $productCatService;
        $this->uploadService = $uploadService;

    }
    public function index()
    {
        $data['title'] = 'Danh sách sản phẩm';
        $data['products'] = $this->productService->filters(['orderBy' => 'id']);
        return view('admin.product.list', $data);
    }

    public function create()
    {
        $data['title'] = 'Thêm mới sản phẩm';
        $data['productCats'] = $this->productCatService->filters(['orderBy' => 'id']);
        return view('admin.product.add', $data);
    }
    public function store(Request $request)
    {
        $rules = [
            'params.name' => 'required|max:255|',
            'params.code' => 'required|max:255',
            'params.price' => 'required|integer',
            'params.price_sale' => 'required|integer',
            'params.description' => 'required',
            'params.content' => 'required',
            'params.cat_id' => 'required',
            'params.active' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
            ]);
        }
        $product = $this->productService->insert($request);
        $this->productService->addThumb($product, $request);
        return response()->json([
            'success' => true,
        ]);
    }

    public function show(Product $product)
    {
        $data['title'] = 'Chỉnh sửa thông tin sản phẩm';
        $data['product'] = $product;
        $data['productCats'] = $this->productCatService->filters(['orderBy' => 'id']);
        $data['Medias'] = $this->uploadService->filters(['orderBy' => 'id']);
        return view('admin.product.edit', $data);
    }

    public function update(ProductRequest $request, Product $product)
    {
        //trả về products đã được update
        $products = $this->productService->update($request, $product);
        $thumbs = $request->input('thumb');
        $nameThumb = $request->input('image_name');
        $this->productService->addThumbupdate($product, $thumbs, $nameThumb);
        if ($products) {
            return redirect()->route('products.list');
        }
        return redirect()->back();

    }
    public function destroy(Request $request)
    {
        $result = $this->productService->destroy($request);
        if ($result) {
            return response()->json([
                'error' => false,
            ]);
        }
        return response()->json([
            'error' => true,
        ]);
    }
}
