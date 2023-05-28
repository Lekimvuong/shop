<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCat\ProductCatRequest;
use App\http\Services\productCat\productCatService;
use Illuminate\Http\Request;
use App\Models\productCat;
class ProductCatController extends Controller

{
    
    protected $productCatService; // Tạo thuộc tính cho class
    public function __construct(productCatService $productCatService)
    { 
        $this->productCatService = $productCatService;
    }
    public function index()
    {
        $productCats = $this->productCatService->getAll();
        return view('admin.productCat.list', ['title' => 'Danh mục sản phẩm',
            'productCats' => $productCats
        ]);
    }
    public function create()
    {
        return view('admin.productCat.add', ['title' => 'Danh mục sản phẩm',
        'productCats' => $this->productCatService->getParent(),
        ]);
    }
    public function store(ProductCatRequest $request)
    {
        $result = $this->productCatService->create($request);
        return redirect()->back();

    }
    public function destroy(Request $request)
    {
        $result = $this->productCatService->destroy($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công danh mục',
            ]);
        }
        return response()->json([
            'error' => true,
        ]);
    }
    public function show(productCat $productCat)
    {
        return view('admin.productCat.edit',
            ['title' => 'Chỉnh sửa danh mục sản phẩm '.$productCat->name,
                'productCat' => $productCat,
                'productCats' => $this->productCatService->getParent()
            ]);
    }
    public function update(productCat $productCat, ProductCatRequest $request)
    {

        $this->productCatService->update($request, $productCat);
        return redirect()->route('productCat.list');
    }
}
