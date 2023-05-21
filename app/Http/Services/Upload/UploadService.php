<?php
namespace App\http\Services\Upload;
use App\Models\Product;
use App\Models\Media;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
class UploadService
{
     public function store($request)
     {
         if ($request->hasFile('file')) {
             try {
                $pathFull = 'uploads/' . date("Y/m/d");
                $image = $request->file('file');
                 $name = $image->getClientOriginalName();
                 $image->storeAs(
                    'public/' . $pathFull, $name
                 );

                 return '/storage/' . $pathFull . '/' . $name;
             } catch (\Exception $error) {
                 return false;
             }
         }

     }
   
    public function multipleStore($request)
    {
        try {
            $url = array();
                if ($request->hasfile('files')) {
                    $images = $request->file('files');
                    foreach ($images as $image) {
                        $pathFull = 'uploads/' . date("Y/m/d");
                        $name = $image->getClientOriginalName();
                        $image->storeAs(
                            'public/' . $pathFull, $name
                        );
                        $url[] = '/storage/' . $pathFull . '/' . $name;
                    }
                }
            return $url;
        } catch (\Exception $err) {
            return false;
        }

    }
    public function getProductId(){
        return Product::get();
    }
     public function get()
 {
    return Media::with('cat_id')->orderByDesc('id')->paginate(10);
}
public function insert($request){

    try {
        foreach ($request->input('thumb') as $thumb) {
            Media::create([
                'name'=> (string)basename($thumb),
                'thumb' => $thumb,
                'product_id' => (int) $request->input('product_id'),
            ]);
        }
        Session::flash('success', 'Thêm hình ảnh thành công');
    } catch (\Exception $err) {
        Session::flash('error', 'Thêm hình ảnh sản phẩm lỗi');
        Log::info($err->getMessage());
        return false;
    }

    return true;
}
public function delete($request){
    foreach ($request->input('urlImage') as $path) {
        if( $path){
            $relative_path = str_replace('/storage/', '', $path);
            $storage_path = '/public/' . $relative_path;
            $isFile = Storage::exists($storage_path);
            if ($isFile) {
                Storage::delete($storage_path);
            }
         return true;
         }
         else{
            return false;
         }
    }
   
}
public function update($request, $media)
{
    return true;
}
}
