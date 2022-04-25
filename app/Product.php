<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_detail_id',
        'category_id',
        'name',
        'price'
    ];

    public static $allowOrder = [
        'product_detail_id',
        'category_id',
        'name',
        'price',
        'id',
        'created_at',
        'updated_at'
    ];

    public function productDetail(){
        return $this->belongsTo(ProductDetail::class, 'product_detail_id', 'id')->withDefault();
    }
    
    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id')->withDefault();
    }

}
