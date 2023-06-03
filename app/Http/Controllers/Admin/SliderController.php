<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\http\Services\Slider\SliderService;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    //
    protected $slider; // Tạo thuộc tính cho class
    public function __construct(SliderService $slider)
    {
        $this->slider = $slider;
    }
    public function create()
    {
        return view('admin.slider.add', ['title' => 'Thêm mới slider',
        ]);
    }
    public function store(Request $request)
    {$this->validate($request, [
        'name' => 'required',
        'url' => 'required',
        'sort_by' => 'required',
        'active' => 'required',
    ],
        [
            'name.required' => 'Vui lòng nhập tên',
            'url.required' => 'Vui lòng nhập URL',
            'sort_by.required' => 'Vui lòng nhập sort by',
            'active.required' => 'Vui lòng nhập trạng thái active',
        ]
    );
        $this->slider->insert($request);
        return redirect()->back();

    }

    public function index()
    {
        return view('admin.slider.list', ['title' => 'Danh sách slider',
       'sliders'=> $this->slider->get()
        ]);
      
    }

}
