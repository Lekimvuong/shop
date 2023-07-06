<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\http\Services\Slider\SliderService;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    {
        $rules = [
            'params.name' => 'required|max:255|',
            'params.url' => 'required',
            'params.sort_by' => 'required',
            'params.active' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
            ]);
        }
        $status = $this->slider->insert($request);
        if ($status == true) {
            return response()->json([
                'success' => true,
            ]);
        }
        return response()->json([
            'success' => false,
        ]);

    }

    public function index()
    {
        return view('admin.slider.list', ['title' => 'Danh sách slider',
            'sliders' => $this->slider->get(),
        ]);

    }
    public function show(Slider $slider)
    {
        $data['title'] = 'CHỉnh sửa slider';
        $data['slider'] = $slider;
        return view('admin.slider.edit', $data);
    }
    public function update(Slider $slider, Request $request)
    {
        $this->validate($request, [
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
        $results = $this->slider->update($slider, $request);

        if ($results) {
            return redirect()->route('slider.list');
        } else {
            return redirect()->back();
        }
    }
    public function destroy(Request $request)
    {
        $result = $this->slider->destroy($request);
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
