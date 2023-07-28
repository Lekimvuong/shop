<?php
namespace App\http\Services\Product;

use App\Models\Media;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ProductService
{

    public function applyFilters($sortBy, $price_sort, $categoryIds)
    {
        $orderBy = '';
        $orderByDesc = '';
        $priceRanges = [
            1 => [0, 1000000],
            2 => [1000000, 5000000],
            3 => [5000000, 10000000],
            4 => [10000000, 20000000],
            5 => [20000000, PHP_INT_MAX],
        ];
        if (isset($priceRanges[$price_sort])) {
            $range = $priceRanges[$price_sort];
            $products = $this->filters([
                'status' => 1,
                'relations' => 'product_cat',
                'categoryIds' => $categoryIds,
                'price_sale' => $range,
                'perPage' => 4,
            ]);
        } else {
            if ($sortBy == 'a-z') {
                $orderBy = 'name';
            } elseif ($sortBy == 'z-a') {
                $orderByDesc = 'name';
            } elseif ($sortBy == 'asc') {
                $orderBy = 'price_sale';
            } elseif ($sortBy == 'desc') {
                $orderByDesc = 'price_sale';
            }
            $products = $this->filters([
                'status' => 1,
                'categoryIds' => $categoryIds,
                'relations' => 'product_cat',
                'orderBy' => $orderBy,
                'orderByDesc' => $orderByDesc,
                'perPage' => 4,
            ]);
        }

        return $products;
    }
    public function filters($filters = [])
    {
        $query = Product::query();
        if (!empty($filters['relations'])) {
            $query->with($filters['relations']);
        }
        if (isset($filters['status'])) {
            $status = intval($filters['status']);
            $query->where('active', $status);
        }

        if (!empty($filters['categoryIds'])) {
            $query = $query->whereIn('cat_id', $filters['categoryIds']);
        }
        if (!empty($filters['price_sale'])) {
            $query = $query->whereBetween('price_sale', $filters['price_sale']);
        }
        if (!empty($filters['orderBy'])) {
            $query->orderBy($filters['orderBy']);
        }
        if (isset($filters['id'])) {
            return $query->where('id', $filters['id'])->first();
        }
        if (!empty($filters['orderByDesc'])) {
            $query->orderByDesc($filters['orderByDesc']);
        }
        if (!empty($filters['perPage'])) {
            $perPage = intval($filters['perPage']);
            return $query->paginate($perPage);
        }
        return $query->get();
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
            $product = Product::create([
                'name' => (string) $params['name'],
                'code' => (string) $params['code'],
                'price' => (int) $params['price'],
                'price_sale' => (int) $params['price_sale'],
                'description' => (string) $params['description'],
                'content' => (string) $params['content'],
                'cat_id' => (int) $params['cat_id'],
                'active' => (int) $params['active'],
            ]);
        }
        return $product;
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
        $thumb = $request->input('params.thumb');
        $productId = $product->id;
        if ($thumb == '') {
            return true;
        } else {
            foreach ($params['thumb'] as $key => $item) {
                Media::create([
                    'name' => (string) $params['name_thumb'][$key],
                    'thumb' => (string) $item,
                    'product_id' => (int) $productId,
                ]);
            }
            return true;
        }

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
    public function getProduct()
    {
        $carts = Session::get('carts');
        if (is_null($carts)) {
            return [];
        }

        $productId = array_keys($carts);
        return Product::with('Media')
            ->where('active', 1)
            ->whereIn('id', $productId)
            ->get();
    }
}
