<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'thumb',
        'product_id',
    ];

     public function cat_id(){
         return $this->hasOne(Product::class, 'id', 'product_id');

     }
}
