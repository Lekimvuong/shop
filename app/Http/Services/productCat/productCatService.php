<?php
namespace App\http\Services\productCat;
use App\Models\productCat;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
class productCatService{
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
    public function getParentCat($productCat)       //Lấy danh mục sản phẩm cha
    {
        $parentId = $productCat->parent_id;
        if ($parentId != 0) {
            return ProductCat::where('active', 1)->where('id', $parentId)->first();
        }
    }

    public function filters($filters = []) {
        $query = ProductCat::query();
    
        if (!empty($filters['relations'])) {
            $query->with($filters['relations']);
        }
        if (isset($filters['parent_id'])) {
            $parentID = intval($filters['parent_id']);
            $query->where('parent_id', $parentID);
        }
        if (isset($filters['active'])) {
            $active = intval($filters['active']);
            $query->where('active', $active);
        }
        if (!empty($filters['orderBy'])) {
            $query->orderBy($filters['orderBy']);
        }
        if (!empty($filters['orderByDesc'])) {
            $query->orderByDesc($filters['orderByDesc']);
        }
        if (!empty($filters['perPage'])) {
            $perPage = intval($filters['perPage']);
            return $query->paginate($perPage);
        }
        if (isset($filters['id'])) {
            return $query->where('id', $filters['id'])->first();
        }
        return $query->get();
    }
}
