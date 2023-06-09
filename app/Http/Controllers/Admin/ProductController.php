<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\http\Services\Product\ProductService;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function index()
    {
        return view('admin.product.list', ['title' => 'Danh sách sản phẩm',
            'products' => $this->productService->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.add', ['title' => 'Thêm mới sản phẩm',
            'productCats' => $this->productService->getproductCats(),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $product = $this->productService->insert($request);

        $this->productService->addThumb($product, $request);
        return redirect()->back();
    }
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $data['title'] = 'Chỉnh sửa thông tin sản phẩm';
        $data['product'] = $product;
        $data['productCats'] = $this->productService->getproductCats();
        $data['Medias'] = $this->productService->getMedia();
        return view('admin.product.edit', $data);
    }

    public function update(ProductRequest $request, Product $product)
    {
        //trả về products đã được update
        $products = $this->productService->update($request, $product);
        //Thêm ảnh vào media khi đã chọn xong ảnh
        $this->productService->addThumb($product, $request);
        if ($products) {
            return redirect()->route('products.list');
        }
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
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
