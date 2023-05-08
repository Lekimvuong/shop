<?php
namespace App\http\Services\productCat;
use App\Models\productCat;
use Illuminate\Support\Facades\Session;

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
    public function update($request, $productCat) :bool
    {
       if($request ->input('parent_id') != $productCat->id){
        $productCat->parent_id = (int) $request->input('parent_id');
       }
       $productCat->name = (string) $request->input('name');
        $productCat->description = (string) $request->input('description');
        $productCat->content = (string) $request->input('content');
        $productCat->active = (int) $request->input('active');
        $productCat->save();
        session::flash('success', 'update danh mục thành công');
       return true;
    }

}
