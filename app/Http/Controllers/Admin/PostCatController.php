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
        $data['title'] = 'Thêm mới bài viết';
        $data['postCats'] = $this->postCatService->getParent();
        return view('admin.postCat.add', $data);

    }
    public function store(CreateFormRequest $request)
    {
        $result = $this->postCatService->create($request);
        return redirect()->back();

    }
    public function index()
    {
        $data['title'] = 'Danh mục bài viết';
        $data['postCats'] = $this->postCatService->getAll();
        return view('admin.postCat.list', $data);
    }
    public function show(PostCat $postCat)
    {
        $data['title'] = 'Chỉnh sửa danh mục bài viết -' . ' '.$postCat->name;
        $data['postCat'] = $postCat;
        $data['postCats'] = $this->postCatService->getParent();
        return view('admin.postCat.edit', $data);
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
