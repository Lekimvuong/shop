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
    protected function isValidPriceCreate($request)
    {
        if (
            $request->input('params.price') !== 0 && $request->input('params.price_sale') !== 0
            && $request->input('params.price_sale') >= $request->input('params.price')
        ) {
            return false;
        }
        if ($request->input('params.price_sale') !== 0 && (int) $request->input('params.price') == 0) {
            return false;
        }
        return true;
    }
    protected function isValidPrice($request)
    {
        if (
            $request->input('price') !== 0 && $request->input('price_sale') !== 0
            && $request->input('price_sale') >= $request->input('price')
        ) {
            return false;
        }
        if ($request->input('price_sale') !== 0 && (int) $request->input('price') == 0) {
            return false;
        }
        return true;
    }
    public function insert($request)
    {
        $params = $request->input('params');
        $isValidPrice = $this->isValidPriceCreate($request);
        if ($isValidPrice == false) {
            return false;
        }
        if ($params) {
             $product =  Product::create([
                    'name' => (string) $params['name'],
                    'code' => (string) $params['code'],
                    'price' => (int) $params['price'],
                    'price_sale'=> (int) $params['price_sale'],
                    'description'=>(string)$params['description'],
                    'content'=>(string)$params['content'],
                    'cat_id'=>(int) $params['cat_id'],
                    'active'=>(int) $params['active'],
                ]);
        }
           return $product;
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
            return $product;
        } catch (\Exception $err) {
            Session::flash('error', 'Cập nhật thất bại');
            Log::info($err->getMessage());
            return false;
        }

    }

    public function addThumb($product, $request)
    {
        $params = $request->input('params');
        $productId = $product-> id;
        if ($params) {
            foreach ($params['thumb'] as $key => $item) {
                Media::create([
                    'name' => (string) $params['name_thumb'][$key],
                    'thumb' => (string) $item,
                    'product_id' => (int) $productId,
                ]);
            }
            return true;
        }
        return false;
    }
    public function addThumbupdate($product, $thumbs, $nameThumb)
    {
        try {
            foreach ($thumbs as $key => $thumb) {
                Media::create([
                    'name' => $nameThumb[$key],
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
