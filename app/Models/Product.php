<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'price',
        'price_sale',
        'description',
        'content',
        'cat_id',
        'active'
    ];

    public function product_cat(){
        return $this->hasOne(productCat::class, 'id', 'cat_id');
    }
    public function Media()
    {
        return $this->hasMany(Media::class, 'product_id', 'id');
    }
}
