<?php
namespace App\http\Services\Product;

use App\Models\Media;
use App\Models\Product;
use App\Models\productCat;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ProductService
{
    public function getproductCats()
    {
        return productCat::get();
    }
    protected function isValidPrice($request)
    {
        if (
            $request->input('price') !== 0 && $request->input('price_sale') !== 0
            && $request->input('price_sale') >= $request->input('price')
        ) {
            Session::flash('error', 'Giá giảm phải nhỏ hơn giá gốc');
            return false;
        }

        if ($request->input('price_sale') !== 0 && (int) $request->input('price') == 0) {
            Session::flash('error', 'Vui lòng nhập giá gốc');
            return false;
        }

        return true;
    }
    public function insert($request)
    {
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice == false) {
            return false;
        }

        try {
            $request->except('_token', 'btn-submit', );
            $product = Product::create($request->all());
            Session::flash('success', 'Thêm sản phẩm thành công');
            return $product;

        } catch (\Exception $err) {
            Session::flash('error', 'Thêm sản phẩm lỗi');
            Log::info($err->getMessage());
            return false;
        }
    }
    public function get()
    {
        return Product::with('product_cat')->orderByDesc('id')->paginate(10);
    }
    public function getMedia()
    {
        return Media::get();
    }
    public function update($request, $product)
    {
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice == false) {
            return false;
        }

        try {
            $product->fill($request->input());
            $product->save();
            Session::flash('success', 'Cập nhật thành công');
            return true;
        } catch (\Exception $err) {
            Session::flash('error', 'Cập nhật thất bại');
            Log::info($err->getMessage());
            return false;
        }

    }

    public function addThumb($product, $thumbs)
    {
        try {
            foreach ($thumbs as $thumb) {
                Media::create([
                    'name' => (string) basename($thumb),
                    'thumb' => $thumb,
                    'product_id' => (int) $product->id,
                ]);
            }
            Session::flash('success', 'Thêm hình ảnh thành công');
            return true;
        } catch (\Exception $err) {
            Session::flash('error', 'Thêm hình ảnh sản phẩm lỗi');
            Log::info($err->getMessage());
            return false;
        }
    }
    public function destroy($request)
    {
        $id = (int) $request->input('id');
        $media = Media::where('product_id', $id);
        $product = Product::where('id', $id)->first();
        if ($product) {
            $product->delete();
            $media->delete();
            return true;
        }
        return false;
    }
}
