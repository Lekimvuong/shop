<?php

namespace App\Http\Services\Product;

use App\Models\Product;

class ProductClientService
{
    public function get()
    {
        return Product::with('media')
            ->where('active', 1)
            ->limit(8)
            ->orderByDesc('price_sale')
            ->get();
    }
}
