<?php
namespace App\http\Services\Post;
use App\Models\Post;
use Illuminate\Support\Facades\Session;

/**
 * Summary of PostService
 */
class PostService
{
    public function getParent()
    {
        return Post::where('parent_id', 0)->get();
    }
    public function getAll()
    {
        $posts = Post::where('active', 1)->get();
        return $posts;
    }
    public function create($request)
    {
        try {
            Post::create([
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
        $post = Post::where('id', $id)->first();
        if ($post) {
            return Post::where('id', $id)->orWhere('parent_id', $id)->delete();
        } 
        return false;
    }
}
