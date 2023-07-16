<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\http\Services\Product\ProductService;
use App\http\Services\Upload\UploadService;
use App\Models\Media;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UploadController extends Controller
{
    protected $upload;
    protected $productService;
    public function __construct(UploadService $upload, ProductService $productService)
    {
        $this->upload = $upload;
        $this->productService = $productService;
    }
    public function create(Request $request)
    {
        $data['title'] = 'Thêm mới media';
        $data['product_id'] = $this->productService->filters(['orderBy' => 'id']);
        return view('admin.media.add', $data);

    }
    public function index()
    {
        $data['title'] = 'Danh sách media';
        $data['Medias'] = $this->upload->filters(['relations' => 'cat_id', 'orderByDesc' => 'id']);
        return view('admin.media.list', $data);

    }

    // update ảnh
    public function store(Request $request)
    {
        $rules = [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ];

        $validator = Validator::make($request->all(), $rules); //Validate theo rule ở $rule
        if ($validator->passes()) {
            $urls = $this->upload->store($request);
            $name = $urls[0];
            $url = $urls[1];
            $public_id = $urls[2];
            if ($urls !== false) {
                return response()->json([ //Nếu pass thì return ở đây
                    'error' => false,
                    'url' => $url,
                    'name' => $name,
                    'public_id' => $public_id,
                ]);
            }
        }
        return response()->json([
            'error' => $validator->errors(),
        ]);
    }
    public function multiStore(Request $request)
    {
        $rules = [
            'files.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $urls = $this->upload->multipleStore($request);
            $name_image = $urls[0];
            $url = $urls[1];
            $count = count($url);
            if ($url !== false) {
                return response()->json([
                    'error' => false,
                    'url' => $url,
                    'count' => $count,
                    'name' => $name_image,
                ]);
            }
        }
        return response()->json([
            'error' => $validator->errors(),
        ]);
    }
    public function insertImages(Request $request)
    {
        //rules của request params
        $rules = [
            'params.thumb' => 'required',
            'params.product_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
            ]);
        }
        $status = $this->upload->insert($request);
        if ($status == true) {
            return response()->json([
                'success' => true,
            ]);
        }
        return response()->json([
            'success' => false,
        ]);
    }
    public function delete(Request $request)
    {
        $status = $this->upload->delete($request);
        if ($status != false) {
            return response()->json([
                'success' => true,
            ]);
        }
        return response()->json([
            'success' => false,
        ]);

    }
    public function show(Media $media)
    {
        $data['title'] = 'Chỉnh sửa thông tin Media';
        $data['media'] = $media;
        $data['products'] = $this->productService->filters(['orderBy' => 'id']);
        return view('admin.Media.edit', $data);
    }

    public function update(Request $request, Media $media)
    {
        $result = $this->upload->update($request, $media);
        if ($result) {
            return redirect()->route('Upload.list');
        }
        return redirect()->back();

    }

    public function deleteOld(Request $request)
    {
        //xóa ảnh cũ đầu tiên khi chưa có sẵn Public_id
        $path = $request->input('input');
        $publicId = basename(parse_url($path, PHP_URL_PATH), '.' . pathinfo($path, PATHINFO_EXTENSION));
        //Các ảnh sau này đã có publicid
        Cloudinary::destroy($publicId);
        $status = $this->upload->deleteOld($request);
        if ($status != false) {
            return response()->json([ //Nếu pass thì return ở đây
                'success' => true,
            ]);
        }
        return response()->json([ //Nếu pass thì return ở đây
            'success' => false,
        ]);
    }
    public function destroy(Request $request)
    {
        $result = $this->upload->destroy($request);
        if ($result) {
            return response()->json([
                'error' => false,
            ]);
        }
        return response()->json([
            'error' => true,
        ]);
    }
}
