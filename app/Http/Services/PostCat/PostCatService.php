<?php
namespace App\http\Services\PostCat;
use App\Models\PostCat;
use Illuminate\Support\Facades\Session;

/**
 * Summary of PostService
 */
class PostCatService
{
    public function getParent()
    {
        return PostCat::where('parent_id', 0)->get();
    }
    public function getAll()
    {
        $postCats = PostCat::get();
        return $postCats;

    }
    public function create($request)
    {
        try {
            PostCat::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'active' => (string) $request->input('active'),
            ]);
            session::flash('success', 'tạo danh mục thành công');
        } catch (\Exception$err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

    public function destroy($request)
    {
        $id = (int) $request->input('id');
        $postCat = PostCat::where('id', $id)->first();
        if ($postCat) {
            return PostCat::where('id', $id)->orWhere('parent_id', $id)->delete();
        } 
        return false;
    }
    public function update($request, $postCat) :bool
    {
       if($request ->input('parent_id') != $postCat->id){
        $postCat->parent_id = (int) $request->input('parent_id');
       }
        $postCat->name = (string) $request->input('name');
        $postCat->description = (string) $request->input('description');
        $postCat->content = (string) $request->input('content');
        $postCat->active = (int) $request->input('active');
        $postCat->save();
        session::flash('success', 'update danh mục thành công');
       return true;
    }
}
