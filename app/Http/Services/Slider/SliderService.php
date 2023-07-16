<?php
namespace App\http\Services\Slider;

use App\Models\Slider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class SliderService
{
    public function insert($request)
    {
        $params = $request->input('params');
        if ($params) {
            try {
                Slider::create([
                    'name' => (string) $params['name'],
                    'url' => (string) $params['url'],
                    'sort_by' => (int) $params['sort_by'],
                    'thumb' => $params['thumb'],
                    'active' => (int) $params['active'],
                ]);
                return true;
            } catch (\Exception $err) {
                Log::info($err->getMessage());
                return false;
            }
        }
        return false;

    }
    public function get()
    {
        return SLider::orderByDesc('id')->paginate(10);
    }
    public function update($slider, $request): bool
    {

        try {
            $slider->fill($request->input());
            $slider->save();
            Session::flash('success', 'Cập nhật thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Cập nhật thất bại');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function destroy($request)
    {
        $id = (int) $request->input('id');
        $slider = Slider::where('id', $id)->first();
        if ($slider) {
            Slider::where('id', $id)->delete();
            return true;
        }
        return false;
    }

    
}
