<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CreateFormRequest;
use App\http\Services\Post\PostService;
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
        return view('admin.post.add', ['title' => 'Thêm mới danh mục',
            'posts' => $this->postService->getParent()
        ]);

    }
    public function store(CreateFormRequest $request)
    {
        $result = $this->postService->create($request);
        return redirect()->back();

    }
    public function index()
    {
      
        return view('admin.post.list-posts', ['title' => 'Danh sách bài viết',
            'posts' => $this->postService->getAll()
        ]);

    }}
