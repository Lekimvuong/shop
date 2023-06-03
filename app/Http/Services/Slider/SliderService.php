<?php
namespace App\http\Services\Slider;
use App\Models\Slider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class SliderService{
    public function insert($request)
    {
        try {
            Slider::create($request->input());
            Session::flash('success', 'Thêm slider thành thành công');
            
        } catch (\Exception $err) {
            Session::flash('error', 'Thêm slider lỗi');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function get()
    {
        return SLider::orderByDesc('id')->paginate(10);
    }
}