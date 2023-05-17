<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Media\MediaRequest;
use App\http\Services\Upload\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    // public function store(Request $request)
    // {
    //     $result = $this->validate($request, ['file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000'], [
    //         'file.required' => 'Ảnh đại diện không được trống',
    //         'file.image' => 'File upload phải là file ảnh',
    //         'file.nimes' => 'File upload phải là jpeg, png, jpg, gif, svg',
    //         'file.max' => 'File không lớn hơn 10000',
    //     ]
    //     );
    //     if ($result) {
    //         $url = $this->upload->store($request);
    //         if ($url !== false) {
    //             return response()->json([
    //                 'error' => false,
    //                 'url' => $url,
    //             ]);
    //         }
    //         return response()->json(['error' => true]);
    //     }
    // }
    public function index()
    {
        return view('admin.media.list', ['title' => 'Danh sách media',
        'Medias' => $this->upload->get()
        ]);

    }
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
}
