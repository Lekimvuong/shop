<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CreateFormRequest;
use App\http\Services\Post\PostService;

class PostController extends Controller
{
    protected $postService; //
    public function __construct(PostService $postService) // hàm constructor của class Postcontroller
    {
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
}
