<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Media\MediaRequest;
use App\http\Services\Upload\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Media;

class UploadController extends Controller
{
    protected $upload; // Tạo thuộc tính cho class
    public function __construct(UploadService $upload)
    {
        $this->upload = $upload;
    }
    public function create(Request $request)
    {
        return view('admin.media.add', ['title' => 'Thêm mới media',
            'product_id' => $this->upload->getProductId(),
        ]);

    }
       public function index()
    {
        return view('admin.media.list', ['title' => 'Danh sách media',
        'Medias' => $this->upload->get()
        ]);

    }

    // update ảnh 
    public function store(Request $request)
    {
        $rules = [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ];

        $validator = Validator::make($request->all(), $rules);   //Validate theo rule ở $rule
        if ($validator->passes())   //Check có pass các rules trên ko
        {
            $urls = $this->upload->store($request);
            $name = $urls[0];
            $url = $urls[1];
            if ($urls!== false) 
            {
                return response()->json([       //Nếu pass thì return ở đây
                    'error' => false,
                    'url' => $url,
                    'name'=> $name
                ]);
            }
        }  
        return response()->json([
            'error' => $validator->errors(),
        ]);
    }
    
    //thêm ảnh
    public function multiStore(Request $request)
    {
        $rules = [
            'files.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ];

        $validator = Validator::make($request->all(), $rules);   //Validate theo rule ở $rule
        if ($validator->passes())   //Check có pass các rules trên ko
        {
            $url = $this->upload->multipleStore($request);
            if ($url !== false) 
            {
                return response()->json([       //Nếu pass thì return ở đây
                    'error' => false,
                    'url' => $url,
                ]);
            }
        }  
        return response()->json([
            'error' => $validator->errors(),
        ]);
    }
    public function insertImages(MediaRequest $request)
    {
        $this->upload->insert($request);
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $status = $this->upload->delete($request);
        if($status!= false){
            return response()->json([       //Nếu pass thì return ở đây
                'success' => true,
            ]);
        }
        return response()->json([       //Nếu pass thì return ở đây
            'success' => false,
        ]);

    }
    public function show(Media $media)
    {
        $data['title'] = 'Chỉnh sửa thông tin Media';
        $data['media'] = $media;
        $data['products'] = $this->upload->getProductId();
        return view('admin.Media.edit', $data);
    }

    public function update(Request $request,Media $media)
    {
        $result = $this->upload->update($request, $media);
        if($result){
            return redirect()->route('Upload.list');
        }
        return redirect()->back();
       
    }

    public function deleteOld(Request $request)
    {
        $status = $this->upload->deleteOld($request);
        if($status!= false){
            return response()->json([       //Nếu pass thì return ở đây
                'success' => true,
            ]);
        }
        return response()->json([       //Nếu pass thì return ở đây
            'success' => false,
        ]);
    }
    public function destroy(Request $request)
    {
        $result = $this->upload->destroy($request);
        if ($result) {
            return response()->json([
                'error' => false
            ]);
        }
        return response()->json([
            'error' => true
        ]);
    }
}
