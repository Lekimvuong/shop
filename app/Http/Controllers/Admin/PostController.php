<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CreateFormRequest;
use App\http\Services\Post\PostService;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    protected $postService; // Tạo thuộc tính cho class
    public function __construct(PostService $postService)
    { // hàm dựng, truyền class PostService vào class Postcontroller {
        $this->postService = $postService;
    }
    public function create()
    {
        return view('admin.post.add', ['title' => 'Thêm mới bài viết',
            'posts' => $this->postService->getParent(),
        ]);

    }
    public function store(CreateFormRequest $request)
    {
        $result = $this->postService->create($request);
        return redirect()->back();

    }
    public function index()
    {
        $posts = $this->postService->getAll();
        return view('admin.post.list-posts', ['title' => 'Danh sách bài viết',
            'posts' => $posts
        ]);

    }
    public function show(Post $post)
    {
        
        return view('admin.post.edit', 
        ['title' =>'Chỉnh sửa bài viết' .$post->name, //$post này chính là bản ghi cần lấy để edit
        'post'=> $post,
        'posts' => $this->postService->getParent()
    ]);

    }


    public function destroy(Request $request)
    {
        $result = $this->postService->destroy($request);
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
}
