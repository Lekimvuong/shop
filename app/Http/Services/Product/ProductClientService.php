<?php

namespace App\Http\Services\Product;

use App\Models\Product;

class ProductClientService
{
    const LIMIT = 8;
    public function get()
    {
        return Product::with('media')
            ->where('active', 1)
            ->orderByDesc('price_sale')
            ->get();
    }
}
