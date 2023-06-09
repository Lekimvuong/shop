<?php
namespace App\http\Services\Upload;

use App\Models\Media;
use App\Models\Product;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UploadService
{
    public function store($request)
    {
        if ($request->hasFile('file')) {
            try {
                $urls = array();
                // $pathFull = 'uploads/' . date("Y/m/d");
                // $image = $request->file('file');
                // $extension = $image->getClientOriginalName();
                // $name = '('.time().')' . '.' . $extension;
                // $urls[] = $name;
                // $image->storeAs(
                //     'public/' . $pathFull, $name
                // );
                // $url = '/storage/' . $pathFull . '/' . $name;
                // $urls[] = $url;
                // return $urls;
                $image_name = $request->file('file');
                $extension = $image_name->getClientOriginalName();
                $name = '(' . time() . ')' . '.' . $extension;
                $urls[] = $name;
                $uploadedFileUrl = Cloudinary::upload($image_name->getRealPath())->getSecurePath();
                $urls[] = $uploadedFileUrl;
                $publicId = basename(parse_url($uploadedFileUrl, PHP_URL_PATH), '.' . pathinfo($uploadedFileUrl, PATHINFO_EXTENSION));
                $urls[] = $publicId;
                return $urls;
            } catch (\Exception $error) {
                return false;
            }
        }

    }

    public function multipleStore($request)
    {
        try {
            $url = array();
            $name_image = array();
            if ($request->hasfile('files')) {
                $images = $request->file('files');
                foreach ($images as $image) {
                    // $pathFull = 'uploads/' . date("Y/m/d");
                    // $extension = $image->getClientOriginalName();
                    // $name = time() . '.' . $extension;
                    // $image->storeAs(
                    //     'public/' . $pathFull, $name
                    // );
                    $extension = $image->getClientOriginalName();
                    $name = '(' . time() . ')' . '.' . $extension;
                    $name_image[]= $name;
                    $url[] = Cloudinary::upload($image->getRealPath())->getSecurePath();
                }
            }
            return array($name_image, $url);
        } catch (\Exception $err) {
            return false;
        }

    }
    public function getProductId()
    {
        return Product::get();
    }
    public function get()
    {
        return Media::with('cat_id')->orderByDesc('id')->paginate(10);
    }
    public function insert($request)
    {

        try {
            foreach ($request->input('thumb') as $thumb) {
                Media::create([
                    'name' => (string)$request->input('image_name'),
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
    public function delete($request)
    {
        if ($request->input('urlImage')) {
            foreach ($request->input('urlImage') as $path) {
                if ($path) {
                    $publicId = basename(parse_url($path, PHP_URL_PATH), '.' . pathinfo($path, PATHINFO_EXTENSION));
                    Cloudinary::destroy($publicId);
                    Media::where('thumb', $path)->delete();
                }
            }
            return true;
        } else {
            return false;
        }
    }
    public function update($request, $media)
    {

        try {
            $media->fill($request->input());
            $media->save();
            Session::flash('success', 'Cập nhật thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Cập nhật thất bại');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function deleteOld($request)
    {
        $path = $request->input('input');
        if ($path) {
            Cloudinary::destroy($path);
            return true;
        }
        return false;

    }
    public function destroy($request)
    {
        $id = (int) $request->input('id');
        $media = Media::where('id', $id);
        if ($media) {
            $media->delete();
            return true;
        }
        return false;
    }
}
