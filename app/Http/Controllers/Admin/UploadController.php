<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\http\Services\Upload\UploadService;
use Illuminate\Http\Request;

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
        ]);

    }
    public function store(Request $request)
    {
        $result = $this->validate($request, ['file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000'], [
            'file.required' => 'Ảnh đại diện không được trống',
            'file.image' => 'File upload phải là file ảnh',
            'file.nimes' => 'File upload phải là jpeg, png, jpg, gif, svg',
            'file.max' => 'File không lớn hơn 10000',
        ]
        );
        if ($result) {
            $url = $this->upload->store($request);
            $name = $this->upload->getNameMedia($request);
            if ($url !== false) {
                return response()->json([
                    'error' => false,
                    'url' => $url,
                    'name'=> $name
                ]);
            }
            return response()->json(['error' => true]);
        }
    }
    public function index(){
        return view('admin.media.list', ['title' => 'Danh sách media',
    ]);
        
    }
    public function multiStore(Request $request){
   
           $url = $this->upload->multipleStore($request);
            if ($url !== false) {
                return response()->json([
                    'error' => false,
                    'url' => $url,
                ]);
            }
            return response()->json(['error' => true]);
    }
    }

