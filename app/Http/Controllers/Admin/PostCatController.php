<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostCat\CreateFormRequest;
use App\http\Services\PostCat\PostCatService;
use App\Models\PostCat;
use Illuminate\Http\Request;

class PostCatController extends Controller
{
    protected $postCatService; // Tạo thuộc tính cho class
    public function __construct(PostCatService $postCatService)
    { 
        $this->postCatService = $postCatService;
    }
    public function create()
    {
        return view('admin.postCat.add', ['title' => 'Thêm mới bài viết',
            'postCats' => $this->postCatService->getParent(),
        ]);

    }
    public function store(CreateFormRequest $request)
    {
        $result = $this->postCatService->create($request);
        return redirect()->back();

    }
    public function index()
    {
        $postCats = $this->postCatService->getAll();
        return view('admin.postCat.list', ['title' => 'Danh mục bài viết',
            'postCats' => $postCats
        ]);
    }
    public function show(PostCat $postCat)
    {

        return view('admin.postCat.edit',
            ['title' => 'Chỉnh sửa danh mục bài viết' . $postCat->name, //$post này chính là bản ghi cần lấy để edit
                'postCat' => $postCat,
                'postCats' => $this->postCatService->getParent(),
            ]);
    }
    public function update(PostCat $postCat, CreateFormRequest $request)
    {

        $this->postCatService->update($request, $postCat);
        return redirect()->route('postCats.list');
    }

    public function destroy(Request $request)
    {
        $result = $this->postCatService->destroy($request);
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
