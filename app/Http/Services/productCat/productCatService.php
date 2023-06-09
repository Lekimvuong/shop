<?php
namespace App\http\Services\productCat;
use App\Models\productCat;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
class productCatService{
    public function getParent()
    {
        return productCat::where('parent_id', 0)->get();
    }
    public function getAll()
    {
        $productCats = ProductCat::get();
        return $productCats;

    }
    public function create($request)
    {
        try {
            productCat::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'slug' => (string) $request->input('slug'),
                'active' => (string) $request->input('active'),
            ]);
            session::flash('success', 'tạo danh mục sản phẩm thành công');
        } catch (\Exception$err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }
    public function destroy($request)
    {
        $id = (int) $request->input('id');
        $productCat = productCat::where('id', $id)->first();
        if ($productCat) {
            return productCat::where('id', $id)->orWhere('parent_id', $id)->delete();
        } 
        return false;
    }
    public function update($request, $productCat) 
    {
       if($request ->input('parent_id') != $productCat->id){
        try {
            $productCat->fill($request->input());
            $productCat->save();
            Session::flash('success', 'Cập nhật thành công');
            return true;
        } catch (\Exception $err) {
            Session::flash('error', 'Cập nhật thất bại');
            Log::info($err->getMessage());
            return false;
        }
       }
    }
    public function getFatherCat()                  //get những danh mục sản phẩm chính
    {
        return ProductCat::where('active', 1)
        ->where('parent_id', 0)
        ->get();
    }
    public function getAllCat()             //get tất cả danh mục sản phẩm
    {
        return ProductCat::where('active', 1)->get();
    }
    public function getId($id)
    {
        return ProductCat::where('id', $id)->where('active', 1)->firstOrFail();
    }
    public function getProduct($productCat)     //Query list products theo category    
    {
        if ($productCat->parent_id == 0) {
            $cats = $productCat->childrens;
            $catId = array();
            foreach ($cats as $cat) {
                $catId[] = $cat->id;
            }
            $products = Product::with('media')->whereIn('cat_id', $catId)->where('active', 1);
            return $products;
           
        } else {
            $products = $productCat->products()->with('media')->where('active', 1);
            return $products;
        }
    }
    public function getChildrenCat($productCat)       //Lấy danh mục sản phẩm con
    {
        $parentId = $productCat->parent_id;
        if ($parentId != 0) {
            return ProductCat::where('active', 1)->where('id', $parentId)->first();
        }
    }
}
