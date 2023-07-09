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
        $data['title'] = 'Danh mục sản phẩm';
        $data['productCats'] = $this->productCatService->getAll();
        return view('admin.productCat.list', $data);
    }
    public function create()
    {
        $data['title'] = 'Thêm mới danh mục sản phẩm';
        $data['productCats'] = $this->productCatService->getParent();
        return view('admin.productCat.add', $data);
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
        $data['title'] = 'Chỉnh sửa danh mục sản phẩm '.$productCat->name;
        $data['productCat'] = $productCat;
        $data['productCats']= $this->productCatService->getParent();
        return view('admin.productCat.edit',$data);
    }
    public function update(productCat $productCat, ProductCatRequest $request)
    {

        $this->productCatService->update($request, $productCat);
        return redirect()->route('productCat.list');
    }
}
